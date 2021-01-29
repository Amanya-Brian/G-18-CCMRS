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
	char buffer[255];
	
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
	
	char patient_details[256];
    	char command[40]; 
	char district[20];
	recv(newsockfd,district,sizeof(district),0);
	while(1)
	{
		n = recv(newsockfd,command,40,0);
		if(n<0)
			perror("Error on reading");
		if(strstr(command,"done"))
		{
			printf("Client Closed the connection, do you want to close too?\n");
			bzero(command,40);
			fgets(buffer,5,stdin);
			if(strstr(buffer,"yes"))
			    break;
		}
        
		else if(strstr(command,"Addpatient")){
		//Inserting patient into file
        	bzero(command,40);
		FILE *fp;
		char file_path[4] = ".txt";
		strcat(district,file_path);
        	recv(newsockfd,patient_details,sizeof(patient_details),0);
        	fp = fopen(district, "a");
   		//writing patient to a district file
        	fprintf(fp ,"%s\n", patient_details);
            	printf("\nSuccessfully added to %s",district);
        	fclose(fp);
        	bzero(patient_details,sizeof(patient_details));
        	printf("\n");
		char status[255] = "Patient Added Successfully\n";
		n = send(newsockfd,status,strlen(status),0);
			if(n<0)
				perror("Error on writing");
		district=="";
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
	
