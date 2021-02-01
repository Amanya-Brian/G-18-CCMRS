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
	struct patient_details{
		char fName[15];
		char lName[15];
		char dateFound[10];
		char gender[1];
		char category[20];
		char healthOfficer[20];
	}patient;
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
	//fgets(district,sizeof(district),stdin);
	scanf("%s",district);
	send(sockfd,district,sizeof(district),0);
	char command[256];
	while(1)
	{
		//Getting command
		scanf("%s\t",command);
		send(sockfd,command,100,0);
		//breaking out of the loop
		if(strstr(command,"done")){
		bzero(command,sizeof(command));
			break;
			close(sockfd);
		}
			
		//Adding Patient
		else if(strstr(command,"Addpatient")){
		bzero(command,40);
		//fgets(patient_details,255,stdin);
	scanf("%s\t%s\t%s\t%s\t%s\t%s",patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
		n = send(sockfd,(struct patient_details *)&patient,sizeof(patient),0);
		if(n<0)
			perror("Error on writing");
		bzero((void *)&patient,sizeof(patient));
		char status[40];
		n = recv(sockfd,status,sizeof(status),0);
		if(n<0)
			perror("Error on reading");
		printf("%s\n",status);
		}
		
        //file check
		else if(strstr(command,file_check))
		{
	    	char file_status[256];

	    	recv(sockfd, file_status, 1000, 0);
	    	printf("%s", file_status);
		}
        	else {
        		bzero(command,40);
        		printf("Invalid Command!\n");
        	}
	}
	close(sockfd);
return 0;
}
