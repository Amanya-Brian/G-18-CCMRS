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


//adding patients function
void addPatient(char *district){
	struct patient_details{
		char fName[15];
		char lName[15];
		char category[20];
		char dateFound[15];
		char healthOfficer[20];
		char gender[6];
	}patient;
	
	//creating patient file
	FILE *fp;
	char *file_path = ".txt";
	char *dFile;
	strcpy(dFile,district);
	strcat(dFile,file_path);
        fp = fopen(dFile, "a");
        scanf("%s %s %s %s %s %s",
	patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
   	
   	//writing patient to a district file
        fprintf(fp ,"%s %s %s %s %s %s\n",
        patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
        fclose(fp);
	}


int main()
{
	int sockfd,n;
	struct sockaddr_in serv_addr;
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
	scanf("%s",district);
	send(sockfd,district,sizeof(district),0);
        	
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
		
	//Adding patient list
		else if(strstr(command,"Addpatientlist"))
		{
		bzero(command,40);
		int count = 0;
		 for(int i=0;i<2;i++)
		 {
			addPatient(district);
			count = count + 1;
		 }
		 printf("Added %d patients to %s.txt\n\n",count,district);
		}
			
		//Adding single patient
		else if(strstr(command,"Addpatient")){
		bzero(command,40);
		addPatient(district);
		printf("Patient successfully added to %s.txt\n\n",district);
		}
				
        //file check
		else if(strstr(command,"Check_status"))
		{
		bzero(command,sizeof(command));
	    	char file_status[100];
	    	char file_name[40];
	    	recv(sockfd, file_status,sizeof(file_status), 0);
	    	printf("There are %s patients in %s file\n\n", file_status,district);
		}
		
	//searching for a patient
		else if(strstr(command,"Search"))
		{
		bzero(command,sizeof(command));
		char criteria[50];
		scanf("%s",criteria);
		char line[100];
		FILE *fp;
		char file_name[40];
		strcpy(file_name,district);
		strcat(file_name,".txt");
		fp = fopen(file_name,"r");
		//printf("Searching for %s\n",criteria);
		while(fgets(line,sizeof(line),fp)!=NULL)
			{
			if(strstr(line,criteria))
			{
			printf("%s\n",line);
			}
			line[0] = '\0';
			}
			bzero(criteria,sizeof(criteria));
			}
        	else {
        		bzero(command,40);
        		printf("Invalid Command!\n");
        	}
	}
	close(sockfd);
return 0;
}
