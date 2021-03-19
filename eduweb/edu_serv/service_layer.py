from flask import Flask,request,abort,json,Response,render_template
from flask_restful import Resource,Api
from flask_mysqldb import MySQL
import mysql.connector
import time
import uuid
from db_layer import *
import sys
import logging

app  = Flask(__name__,template_folder='template')
api = Api(app)

#TODO - make this configurable from app_config.json
valid_token_list = ['edureka321']

def get_ip(request) :
    ip = request.remote_addr
    ipRemote = None
    if request.environ.get('HTTP_X_FORWARDED_FOR') is None:
        ipRemote = request.environ['REMOTE_ADDR']
    else:
        ipRemote = request.environ['HTTP_X_FORWARDED_FOR']

    return ip, ipRemote

def log_request(request):
    ip, ipRemote = get_ip(request)
    logging.info('Request from ' + str(ip) + ' actual ' + str(ipRemote) + str(request))

def validate_ip(request) :
    pass

def generatetime():
    x = int(time.time())
    return x

def generatesessionid():
    x = uuid.uuid4().hex
    return str(x)

class UserLogin(Resource):

    def valid_login(self,request, c_uname, c_hname, c_sname, c_token) :
        if c_token not in valid_token_list :
            self.customError = 'Invalid token ' + c_token
            logging.error(self.customError)
            return False

        if c_uname == '' or c_hname == '' or c_sname == '':
            self.customError = 'Invalid Username or Hostname or Servername'
            logging.error(self.customError)
            return False

        return True



    def post(self):
        self.customError = ''
        if request.method == 'POST':
            try:
                data = request.json
                c_uname = data['username']
                c_hname = data['hostname']
                c_sname = data['servername']
                c_token = data['token']

                logging.info('new login :' + str(c_uname) + ':' + str(c_hname) + ':' + str(c_sname) + ':' + str(c_token))
                if not self.valid_login(request, c_uname, c_hname, c_sname, c_token) :

                    errCode = self.customError
                    return Response(json.dumps({'ErrorMessage':errCode}), status=400, mimetype='application/json')
                    abort(400)

                c_time = generatetime()
                c_sid = generatesessionid()

                logging.info('calling login_api ' + str(c_time) + ';' + str(c_sid))
                login_api(c_hname, c_uname, c_sname, c_sid, c_time)
                return Response(json.dumps({'sessionid':c_sid}),status=200, mimetype='application/json')
            except Exception as e:
                logging.error(str(e))
                return Response(json.dumps({'ErrorMessage':str(e)}), status=500, mimetype='application/json')


class UserAssessment(Resource):

    def valid_assessment(self,request, user_name, problem_id, answer, session_id, c_token, c_date) :
        if c_token not in valid_token_list :
            self.customError = 'Invalid token ' + c_token
            return False

        if user_name =='' or problem_id =='' or answer =='' or session_id =='' or c_date == '':
            self.customError = 'Invalid Username or problem or answer or date'
            return False

        return True


    def match_answer(self,answerType, givenAnswer, dbAnswer) :
        if answerType == 'list' :
            #TODO
            pass
        else :
            if givenAnswer.replace("/\s+/g", " ").lower() == dbAnswer.replace("/\s+/g", " ").lower() :
                logging.info('givenAnswer ' + givenAnswer + ' dbAnswer ' + dbAnswer + ' True')
                return True

        logging.info('givenAnswer ' + givenAnswer + ' dbAnswer ' + dbAnswer + ' False')
        return False


    def post(self):
        self.customError = ''
        if request.method == 'POST':
            try:
                data = request.json
                user_name = data['username']
                problem_id = data['problemid']
                answer = data['answer']
                logactivity = data['log']
                sessionid = data['sessionid']
                c_token = data['token']
                c_date = data['date']

                if not self.valid_assessment(request, user_name, problem_id, answer, sessionid, c_token, c_date) :

                    errCode = self.customError
                    return Response(json.dumps({'ErrorMessage':errCode}), status=400, mimetype='application/json')
                    abort(400)

                problemanswer = get_answer(problem_id)
                answerstatus = ''

                if self.match_answer('single', problemanswer, answer):
                    answerstatus = 'correct answer'
                else:
                    answerstatus = 'wrong answer'
 
                logging.info('matching answer status ' + answerstatus)
                update_result(user_name, problem_id, answer, logactivity, answerstatus, sessionid, c_date)
                return Response(json.dumps({'StatusMessage':str(answerstatus)}),status=200, mimetype='application/json')
            except Exception as e:
                return Response(json.dumps({'ErrorMessage':str(e)}), status=500, mimetype='application/json')
                


class UserActivity(Resource):

    def valid_log(self,request, sessionid, date, problem_id, problem_name, problem_status, token) :
        if token not in valid_token_list :
            self.customError = 'Invalid token ' + c_token
            return False

        if sessionid =='' or date =='' or problem_id =='' or problem_name =='' or problem_status == '':
            self.customError = 'Invalid sessionid or date or problemid or problemname or problemstatus'
            return False

        return True
    
    def post(self):
        if request.method == 'POST':
            try:
                data = request.json
                sessionid = data['sessionid']
                date = data['date']
                problem_id = data['problemid']
                problem_name = data['problemname']
                problem_status = data['problemstatus']
                token = data['token']

                if not self.valid_log(request, sessionid, date, problem_id, problem_name, problem_status, token) :
                    errCode = self.customError
                    return Response(json.dumps({'ErrorMessage':errCode}), status=400, mimetype='application/json')
                    abort(400)
                
                logging.info('calling userlog_api ')
                userlog_api(sessionid, date, problem_id, problem_name, problem_status)
                dbmessage = "Database created successfully"
                return Response(json.dumps({'StatusMessage':str(dbmessage)}),status=200, mimetype='application/json')
            except Exception as e:
                return Response(json.dumps({'ErrorMessage':str(e)}), status=500, mimetype='application/json')

class UserAttemptStatus(Resource):
    def valid_user(self,request,username,token):
        if token not in valid_token_list :
            self.customError = 'Invalid token ' + c_token
            return False

        if username == '':
            self.customError = 'Invalid username'
            return False

        return True


    def post(self):
        if request.method == 'POST':
            try:
                data = request.json
                username = data['username']
                token = data['token']

                if not self.valid_user(request,username,token):
                    errCode = self.customError
                    return Response(json.dumps({'ErrorMessage':errCode}),status = 400, mimetype ='application/json')
                    abort(400)

                logging.info('calling get_status')
                allstatus = get_status(username)
                #print(allstatus)
                dictvalue = {str(allstatus[i][0]):{'attemptdate':allstatus[i][1],'attemptstatus':allstatus[i][2]}for i in range(len(allstatus))}
                return Response(json.dumps(dictvalue),status=200, mimetype='application/json')
            except Exception as e:
                return Response(json.dumps({'ErrorMessage':str(e)}), status=500, mimetype='application/json')




api.add_resource(UserLogin,'/edureka/login')
api.add_resource(UserAssessment,'/edureka/assessment')
api.add_resource(UserActivity,'/edureka/activitylog')
api.add_resource(UserAttemptStatus, '/edureka/attemptstatus')

if __name__ =="__main__":
    logging.basicConfig(stream=sys.stdout, level=logging.DEBUG)
    app.run(host='0.0.0.0', port=80, debug=True)
    #app.run(debug=True)
