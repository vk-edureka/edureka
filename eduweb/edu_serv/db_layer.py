import logging
from db_connector import ConnectDB
from db_connector import field_sanitized


def login_api(hostName, userName, serverName, sessionId, epochTime) :
    arr = [('hostName',hostName), ('userName', userName), ('serverName', serverName), ('sessionId',sessionId), ('epochTime',epochTime)]
    for name,item in arr :
        if not field_sanitized(name,item):
            raise Exception('invalid field', str(item))
    
    sql = 'insert into userinfo (hostname, username, servername, sessionid, epochtime) values(%s, %s, %s, %s, %s)'
    params = (hostName, userName, serverName, sessionId, epochTime)
    
    logging.info('inserting sql ' + sql)
    conn = ConnectDB()
    conn.runDML(sql, params)
    logging.info('inserting sql ' + sql + ' completed')



def get_answer(problem_id) :
    if not field_sanitized('problem_id',problem_id) :
        raise Exception('invalid problem_id ', str(problem_id))

    sql = 'select problemanswer from solutiontable where problemid = \'' + str(problem_id) + '\''
    params = ()
    conn = ConnectDB()
    rows = conn.runSelect(sql, params)

    if len(rows) < 1 :
        raise Exception('problem_id with no solution', str(problem_id))

    logging.info('answer is ')
    logging.info(rows[0])
    return rows[0][0]



def update_result(username, problem_id, answer, activitylog, status, sessionid,c_date) :
    sql = 'insert into userassessmenttable (username, problemid, answer, activitylog, status, sessionid, date) values(%s, %s, %s, %s, %s, %s, NOW())'

    params = (username, problem_id, answer, activitylog, status, sessionid,)
    conn = ConnectDB()
    conn.runDML(sql, params)



def userlog_api(sessionid, date, problem_id, problem_name, problem_status):
    sql = 'insert into useractivitylogtable (sessionid, date, problemid, problemname, problemstatus) values(%s, NOW(), %s, %s, %s)'
    
    params = (sessionid, problem_id, problem_name, problem_status,)
    conn = ConnectDB()
    conn.runDML(sql, params)

def get_status(username):
    sql = 'select problemid,max(date),status from userassessmenttable where username = %s group by problemid, date, status order by problemid ASC'
    params = (str(username),)
    conn = ConnectDB()
    rows = conn.runSelect(sql, params)
    return rows

