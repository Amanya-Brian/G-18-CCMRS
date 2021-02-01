#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#define PORT 9898

int main()
{
	int sockfd, newsockfd,n;
	char buffer[10];
	
	struct sockaddr_in serv_addr, cli_addr;
	socklen_t clilen;
	
	sockfd = socket(AF_INET,SOCK_STREAM,0);
	if(sockfd<0)
	{
		perror("Error opening socket");
	}
	
	bzero((char *)&serv_addr,sizeof(serv_addr));
	
	serv_addr.sin_family = AF_INET;
	serv_addr.sin_addr.s_addr = INADDR_ANY;
	serv_addr.sin_port = htons(PORT);
	
	if(bind(sockfd,(struct sockaddr *)&serv_addr,sizeof(serv_addr))<0)
	perror("Binding Failed");

	listen(sockfd, 5);
	clilen = sizeof(cli_addr);
	
	newsockfd = accept(sockfd, (struct sockaddr *)&cli_addr, &clilen);
	if(newsockfd<0)
	perror("Error on Accept");
	
	char district[20];
	recv(newsockfd,district,sizeof(district),0);
	//char patient_details[256];
	struct patient_details{
		char fName[15];
		char lName[15];
		char dateFound[10];
		char gender[1];
		char category[20];
		char healthOfficer[20];
	}patient;
    	char command[40]; 
	while(1)
	{
		n = recv(newsockfd,command,40,0);
		if(n<0)
			perror("Error on reading");
		if(strstr(command,"done"))
		{
			printf("Client Closed the connection, do you want to close too?\n");
			bzero(command,40);
			scanf("%s",buffer);
			if(strstr(buffer,"yes"))
			    break;
		}
        
		else if(strstr(command,"Addpatient")){
		//Inserting patient into file
        	bzero(command,40);
		FILE *fp;
		char *file_path = ".txt";
		char *dFile;
		strcpy(dFile,district);
		strcat(dFile,file_path);
        	recv(newsockfd,(struct patient_details *)&patient,sizeof(patient),0);
        	fp = fopen(dFile, "a");
   		//writing patient to a district file
        	fprintf(fp ,"%s\t%s\t%s\t%s\t%s\t%s\n",patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
            	printf("\nSuccessfully added to %s",district);
        	fclose(fp);
        	bzero((void *)&patient,sizeof(patient));
        	printf("\n");
		char status[255] = "Patient Added Successfully\n";
		n = send(newsockfd,status,strlen(status),0);
			if(n<0)
				perror("Error on writing");
		//free(dFile);
		}
		else
			continue;
	}
	close(newsockfd);
	close(sockfd);
	
	/*
	SAConnection con; // connection object to connect to database 
    SACommandcmd;    // create command object 
    try
    { 
        // connect to database (Oracle in our example) 
        con.Connect("test", "tester", "tester", SA_Oracle_Client); 
  
        // associate a command with connection 
        // connection can also be specified in SACommand constructor 
        cmd.setConnection(&con); 
  
        // create table 
        cmd.setCommandText("create table tbl(id number, name varchar(20));"); 
        cmd.Execute(); 
  
        // insert value 
        cmd.setCommandText("Insert into tbl(id, name) values (1,”Vinay”)"); 
        cmd.setCommandText("Insert into tbl(id, name) values (2,”Kushal”)"); 
        cmd.setCommandText("Insert into tbl(id, name) values (3,”Saransh”)"); 
        cmd.Execute(); 
  
        // commit changes on success 
        con.Commit(); 
        printf("Table created, row inserted!\n"); 
    } 
  
    catch(SAException &x) 
    { 
        // SAConnection::Rollback() 
        // can also throw an exception 
        // (if a network error for example), 
        // we will be ready 
        try
        { 
            // on error rollback changes 
            con.Rollback(); 
        } 
        catch(SAException &) 
        { 
        } 
        // print error message 
  
        printf("%s\n", (const char*)x.ErrText()); 
    } 
*/
return 0;	
}
	
