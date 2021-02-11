#include "/opt/lampp/include/mysql.h"
#include <mysql/mysql.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

FILE *fptr; 

void main() {
	MYSQL *conn;
	MYSQL_RES *res;
	MYSQL_ROW row;
	
	char *server = "127.0.0.1";
	char *user = "root";
	char *password = ""; 
	char *database = "test";
	
	char c[100];
	char line[256];
	int i;
	char q[1024];
	
	conn = mysql_init(NULL);
	
	// Connect to database 
	if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0)) {
		fprintf(stderr, "%s\n", mysql_error(conn));
		exit(1);
	}
	
	fptr = fopen("patientRecords.txt", "r");
        
        //if file does not exist	
	if (fptr == NULL)
    	{
        	puts("\nFile does not exit\n");
	}
	
	
	for(i = 1; fgets(line, sizeof(line),fptr) != NULL; i++){
		char *fNamev, *lNamev, *datev, *genderv, *categoryv, *officerv;
		
		fNamev = strtok(line, " ");
		lNamev = strtok(NULL, " ");
		datev = strtok(NULL, " ");
		genderv = strtok(NULL, " ");
		categoryv = strtok(NULL, " ");
		officerv = strtok(NULL, " ");
		
	/*	printf("First Name: ");puts(fNamev);
		printf("Last Name: ");puts(lNamev);
		printf("Date: ");puts(datev);
		printf("Gender: ");puts(genderv);
		printf("Category: ");puts(categoryv);
		printf("Officer: ");puts(officerv);  */
		
		char query_string[] = {"INSERT INTO `patients`(`fName`, `lName`, `date`, `gender`, `category`, `officer`) VALUES('%s', '%s', '%s', '%s', '%s', '%s')"};		
		sprintf(q, query_string, fNamev, lNamev, datev, genderv, categoryv, officerv);
		if (mysql_query(conn, q)) {
			fprintf(stderr, "%s\n", mysql_error(conn));
			exit(1);
		}    
	  }
	
	fclose(fptr);
/*	// reads text until newline is encountered
	
		fscanf(fptr, "%[^\n]", c);
		printf("Data from the file:\n%s\n", c);
		fclose(fptr);
*/
	
  /*      // send SQL query 
	if (mysql_query(conn, "show tables")) {
		fprintf(stderr, "%s\n", mysql_error(conn));
		exit(1);
	}
   
	res = mysql_use_result(conn);
	
	
	// output table name 
	printf("MySQL Tables in mysql database:\n");
   
	while ((row = mysql_fetch_row(res)) != NULL)
		printf("%s \n", row[0]);                   */
   
	/* close connection */
	//mysql_free_result(res);
	mysql_close(conn);
}
