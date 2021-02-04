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
	//binding
	if(bind(sockfd,(struct sockaddr *)&serv_addr,sizeof(serv_addr))<0)
	perror("Binding Failed");
	
	//listening for incoming connections
	listen(sockfd, 5);
	clilen = sizeof(cli_addr);
	
	//accept new connections
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
		char status[255] = "Patient successfully added to ";
		n = send(newsockfd,status,strlen(status),0);
			if(n<0)
				perror("Error on writing");
		}
		else
			continue;
	}
	close(newsockfd);
	close(sockfd);
return 0;	
}
	
