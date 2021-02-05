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
		char category[20];
		char dateFound[15];
		char healthOfficer[20];
		char gender[6];
	}patient;
	char file_check[256] = "Check_status";
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
	//creating patient file
	FILE *fp;
		char *file_path = ".txt";
		char *dFile;
		strcpy(dFile,district);
		strcat(dFile,file_path);
        	fp = fopen(dFile, "a");
        	
	char command[256];
	while(1)
	{
		//Getting command
		scanf("%s",command);
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
		scanf("%s %s %s %s %s %s",
		patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);

   		//writing patient to a district file
        	fprintf(fp ,"%s %s %s %s %s %s\n",
        	patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
            	//printf("Successfully added to %s\n",dFile);
        	fclose(fp);
		bzero((void *)&patient,sizeof(patient));
		char status[40];
		n = recv(sockfd,status,sizeof(status),0);
		if(n<0)
			perror("Error on reading");
		printf("%s%s",status,dFile);
		bzero(status,sizeof(status));
		}
		
        //file check
		else if(strstr(command,"Check_status"))
		{
		bzero(command,sizeof(command));
	    	char file_status[100];
	    	char file_name[40];
	    	//strcpy(file_name,dFile);
	    	//scanf("%s",file_name);
	    	//send(sockfd,file_name,sizeof(file_name),0);
	    	recv(sockfd, file_status,50, 0);
	    	printf("There are %s patients in %s file", file_status,dFile);
		}
        	else {
        		bzero(command,40);
        		printf("Invalid Command!\n");
        	}
	}
	close(sockfd);
return 0;
}
