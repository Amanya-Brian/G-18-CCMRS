#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <string.h>
#include <netdb.h>
#include <arpa/inet.h>
#define PORT 9898

int main()
{
	int sockfd,n;
	struct sockaddr_in serv_addr;
	char patient_details[255];
	char file_check[256];
	//Creating the socket
	sockfd = socket(AF_INET,SOCK_STREAM,0);
	if(sockfd<0)
		perror("Error opening socket");
	
	serv_addr.sin_family = AF_INET;
	serv_addr.sin_addr.s_addr = inet_addr("127.0.0.1");
	serv_addr.sin_port = htons(PORT);
	
	//Connecting to server
	if(connect(sockfd, (struct sockaddr *)&serv_addr,sizeof(serv_addr))<0)
		perror("Connection Faield");
	printf(" --- COVID-19 MANAGEMENT AND REPORTING --- \n\n");
	//capturing district
	char district[40];
	printf(">>>Please Enter your District!\n");
	fgets(district,40,stdin);
	
	char command[256];
	while(1)
	{
		fgets(command,100,stdin);
		send(sockfd,command,100,0);
		if(strstr(command,"bye")){
		break;
		}
			
		//Adding Patient
		if(strstr(command,"Addpatient"))
		{
		send(sockfd,district,40,0);
		fgets(patient_details,255,stdin);
		n = send(sockfd,patient_details,strlen(patient_details),0);
		if(n<0)
			perror("Error on writing");
		bzero(patient_details,255);
		char status[256];
		n = recv(sockfd,status,255,0);
		if(n<0)
			perror("Error on reading");
		printf("%s\n",status);
		bzero(status,255);
		}
		
		else //if(strstr(command,file_check)!=NULL)
		{
	    	char file_status[256];

	    	recv(sockfd, file_status, 1000, 0);
	    	printf("%s", file_status);
		}
	}
	close(sockfd);
return 0;
}
