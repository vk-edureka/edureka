from flask import Flask,request,abort,json,Response,render_template
from flask_restful import Resource,Api
from flask_mysqldb import MySQL
import mysql.connector
import time
import uuid

app  = Flask(__name__,template_folder='template')
api = Api(app)

# configure the database
dbConfig = {
        'user': 'appuser',
        'password': 'khalid123',
        'host': 'localhost',
        'database': 'edurekadb',
        'raise_on_warnings': True
}

@app.route('/')
def hello_form():
    return render_template('userlogin.php')

def generatetime():
    x = int(time.time())
    return x

def generatesessionid():
    x = uuid.uuid4().hex
    return str(x)

class ConnectDB:
    def connect(self):
        return mysql.connector.connect(**dbConfig)

class UserLogin(Resource):
     def post(self):
         if request.method == 'POST':
             try:
                 data = request.json
                 c_uname = data['username']
                 c_hname = data['hostname']
                 c_sname = data['servername']
                 #c_uname = request.form['username']
                 #c_pass = request.form['password']

                 if (c_uname=='' or c_hname=='' or c_sname==''):
                     return Response(json.dumps({'ErrorMessage':'Invalid Username or Hostname or Servername'}), status=400, mimetype='application/json')
                     abort(400)

                 conn = ConnectDB()
                 cnx = conn.connect()
                 cur = cnx.cursor()

                 c_time = generatetime()
                 c_sid = generatesessionid()
                 bool = True
                 #while(bool):
                #     sid = generatesessionid()
                #     cur.execute("SELECT * FROM userinfo WHERE sessionid = '"+ sid + "'" )
                #     rows = cur.fetchall()

                #     if rows is None:
                ##         c_sid = sid
                #         bool = false
        #             else:
                #        bool = True

                 cur.execute("insert into userinfo (hostname, username, servername, sessionid, epochtime) values(%s, %s, %s, %s, %s)",(c_hname, c_uname, c_sname, c_sid, c_time))
                 print("insert statement")

                 cnx.commit()
                 cur.close()
                 cnx.close()
                 #return render_template('loginuser.php',userid=rows)
                 print(c_sid)
                 return Response(json.dumps({'sessionid':c_sid}),status=200, mimetype='application/json')
                 #results = json.dumps(rows)
                 #return Response(results, status=200, mimetype='application/json')
             except Exception as e:
                 return Response(json.dumps({'ErrorMessage':str(e)}), status=500, mimetype='application/json')
                 """
                 rows = cur.fetchone()
                 if rows is None:
                     return Response(json.dumps({'ErrorMessage':'Invalid Username or Password'}), status=400, mimetype='application/json')


                 uid = rows[0]
                 uname = rows[1]
                 upass = rows[2]
                 #uid = rows['userid']
                 #uname = rows['username']
                 #upass = rows['password']
                 print('the values of row is: ', end='' )
                 print(rows)
                 """



class UserAssessment(Resource):
     def post(self):
         if request.method == 'POST':
             try:
                 data = request.json
                 user_name = data['username']
                 problem_id = data['problemid']
                 answer = data['answer']
                 logactivity = data['log']
                 sessionid = data['sessionid']
                 print(user_name)
                 print(problem_id)
                 print(answer)
                 print(logactivity)
                 print(sessionid)
                 #c_uname = request.form['username']
                 #c_pass = request.form['password']

                 if (user_name =='' or problem_id =='' or answer =='' or sessionid ==''):
                     return Response(json.dumps({'ErrorMessage':'Some values are missing'}), status=400, mimetype='application/json')
                     abort(400)

                 conn = ConnectDB()
                 cnx = conn.connect()
                 cur = cnx.cursor()
                 cur.execute("select * from solutiontable where problemid = %s",(problem_id,))
                 rows = cur.fetchone()
                 answerstatus = ""
                 if (rows[1] == answer.strip()):
                    answerstatus = "correct answer"
                 else:
                    answerstatus = "wrong answer"

                 cur.execute("insert into userassessmenttable (username, problemid, answer, activitylog, status, sessionid) values(%s, %s, %s, %s, %s, %s)",(user_name, problem_id, answer, logactivity, answerstatus, sessionid,))
                 cnx.commit()
                 cur.close()
                 cnx.close()
                 #return render_template('loginuser.php',userid=rows)
                 return Response(json.dumps({'StatusMessage':str(answerstatus)}),status=200, mimetype='application/json')
                 #results = json.dumps(rows)
                 #return Response(results, status=200, mimetype='application/json')
             except Exception as e:
                 return Response(json.dumps({'ErrorMessage':str(e)}), status=500, mimetype='application/json')


class UserActivity(Resource):
     def post(self):
         if request.method == 'POST':
             try:
                 data = request.json
                 sessionid = data['sessionid']
                 date = data['date']
                 problem_id = data['problemid']
                 problem_name = data['problemname']
                 problem_status = data['problemstatus']
                 print(sessionid)
                 print(date)
                 print(problem_id)
                 print(problem_name)
                 print(problem_status)

                 if (sessionid =='' or date =='' or problem_id =='' or problem_name =='' or problem_status ==''):
                     return Response(json.dumps({'ErrorMessage':'Some values are missing'}), status=400, mimetype='application/json')
                     abort(400)

                 conn = ConnectDB()
                 cnx = conn.connect()
                 cur = cnx.cursor()

                 cur.execute("insert into useractivitylogtable (sessionid, date, problemid, problemname, problemstatus) values(%s, %s, %s, %s, %s)",(sessionid, date, problem_id, problem_name, problem_status,))
                 cnx.commit()
                 dbmessage = "Database created successfully"
                 cur.close()
                 cnx.close()
                 #return render_template('loginuser.php',userid=rows)
                 return Response(json.dumps({'StatusMessage':str(dbmessage)}),status=200, mimetype='application/json')
                 #results = json.dumps(rows)
                 #return Response(results, status=200, mimetype='application/json')
             except Exception as e:
                 return Response(json.dumps({'ErrorMessage':str(e)}), status=500, mimetype='application/json')


api.add_resource(UserLogin,'/edureka/login')
api.add_resource(UserAssessment,'/edureka/assessment')
api.add_resource(UserActivity,'/edureka/activitylog')

if __name__ =="__main__":
    app.run(debug=True)
