from flask import Flask,request,abort,json,Response,render_template
from flask_restful import Resource,Api
from flask_mysqldb import MySQL
import mysql.connector
import logging

def field_sanitized(fieldValue, fieldName) :
    if '*' in fieldValue or '%' in fieldValue :
        logging.error('insecured values for field ' + str(fieldName) + ':' + fieldValue)
        return False
    else:
        return True

class ConnectDB:
    def __init__(self, configFileName='dbconfig.json') :
        self.configFileName = configFileName
        fp = open(self.configFileName, 'r')
        self.dbConfig = json.load(fp)

    def connect(self):
        self.conn = mysql.connector.connect(**self.dbConfig)

    def disconnect(self):
        self.conn.close()

    def runDML(self, sql, params) :
        self.connect()
        cur = self.conn.cursor()
        logging.info('Executing ' + str(sql))
        cur.execute(sql, params)
        self.conn.commit()
        cur.close()
        self.disconnect()
        logging.info('Execution completed for sql ' + str(sql))

    def runSelect(self, sql, params) :
        self.connect()
        logging.info('Executing ' + str(sql))
        cur = self.conn.cursor()
        cur.execute(sql, params)
        rows = cur.fetchall()
        cur.close()
        self.disconnect()
        logging.info('Execution completed for sql ' + str(sql) + ' rows ' + str(len(rows)))
        return rows



