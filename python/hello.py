import mariadb

mydb = mariadb.connect(
  host="localhost",
  user="root",
  password = ''
)
print(mydb)