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

//commands function
void commands(){
		printf(" \t--------- COVID-19 MANAGEMENT AND REPORTING ---------- \t\n\n");
		printf("\n\t\t\t****** COMMANDS ******");
		printf("\nTo add a patient, type Adppatient firstname lastname datefound gender category officername\n");
		printf("To add patient list, type Addpatientlist\n");
		printf("To add existing patient txt file, type Addpatient filename.txt\n");
		printf("To check file status, type Check_status\n");
		printf("To serarch for patients, type Search criteria\n");
		printf("\n\t\t\t***To end session,type done***\t\t\n\n");
		printf("***********************					**********************\n");
}

//next command function
void next(){
	printf("\t\t\t***** Enter next command *****\t\t\t\n\n");
}

//patient structure
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

//add patient function
void addPatient(char *file_name){
	
        //writing patient to a patientRecords file
        fp = fopen("patientRecords.txt", "a");
   	strcpy(patient.fName,file_name);
   	scanf("%s %s %s %s %s",
	patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
        fprintf(fp ,"%s %s %s %s %s %s\n",
        patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
        fclose(fp);
}

//add patient list
void addPatientList(){
	//opening patient file
        fp = fopen("patientRecords.txt", "a");
   	//writing patient to a patientRecords file
   	scanf("%s %s %s %s %s %s",
	patient.fName,patient.lName,patient.dateFound,patient.gender,patient.category,patient.healthOfficer);
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
	printf(" \t--------- COVID-19 MANAGEMENT AND REPORTING ---------- \t\n\n");
	
	//capturing district
	char district[40];
	printf(">>>Please Enter your District!\n");
	scanf("%s",district);
	send(sockfd,district,sizeof(district),0);
        system("clear");
        commands();
	char command[256];
	while(1)
	{
	//Getting command
		scanf("%s",command);
		send(sockfd,command,100,0);
		
	//breaking out of the loop
		if(strstr(command,"done")){
		system("clear");
		bzero(command,sizeof(command));
		printf("\t\t***** Thank you *****\n");
			break;
			close(sockfd);
		}
		
	//Adding patient list
		else if(strstr(command,"Addpatientlist"))
		{
		system("clear");
        	commands();
        	printf("\t\t\t***** CURRENT OUTPUT *****\t\t\n\n");
		bzero(command,40);
		int count = 0;
		for(int i=0;i<2;i++)
		 {
		 	addPatientList();
			count = count + 1;
		 }
		 printf("Added %d patients to patientRecords.txt\n\n",count);
		 next();
		}
		
			
	//Adding single patient and patient file
		else if(strstr(command,"Addpatient")){
		system("clear");
        	commands();
        	printf("\t\t\t***** CURRENT OUTPUT *****\t\t\n\n");
		bzero(command,40);
		//opening patient file
        	fp = fopen("patientRecords.txt", "a");
        	
        	char file_name[90];
		scanf("%s",file_name);
   		if(strstr(file_name,".txt"))
   		{
   		FILE *fr;
   		char content[200];
 		fr = fopen(file_name,"r");
   		if(fr==NULL){
   		printf("File doesnot exist\n");
   		}
   		while(fgets(content,sizeof(content),fr)!=NULL)
		{
		fprintf(fp,"%s",content);
		//content[0] = '\0';
		}
		fclose(fp);
		fclose(fr);
		printf("Adding patients from %s to patientRecords.txt\n\n",file_name);	
		bzero(file_name,sizeof(file_name));
		next();
   		}
   		else
   		{
		addPatient(file_name);
		printf("Patient successfully added to patientRecords.txt\n\n");
		next();
		}
	}
				
        //file check
		else if(strstr(command,"Check_status"))
		{
		system("clear");
        	commands();
        	printf("\t\t\t***** CURRENT OUTPUT *****\t\t\n\n");
		bzero(command,sizeof(command));
	    	char file_status[100];
	    	char file_name[40];
	    	recv(sockfd, file_status,sizeof(file_status), 0);
	    	printf("There are %s patients in patientRecords.txt\n\n", file_status);
	    	next();
		}
		
	//searching for a patient
		else if(strstr(command,"Search"))
		{
		system("clear");
        	commands();
        	printf("\t\t\t***** CURRENT OUTPUT *****\t\t\n\n");
		bzero(command,sizeof(command));
		char criteria[50];
		scanf("%s",criteria);
		char line[100];
		fp = fopen("patientRecords.txt","r");
		while(fgets(line,sizeof(line),fp)!=NULL)
		{
			if(strstr(line,criteria))
			{
			printf("%s\n",line);
			}
			line[0] = '\0';
		}
			fclose(fp);
			bzero(criteria,sizeof(criteria));
			next();
			}
        	else {
        		system("clear");
        		commands();
        		printf("\t\t\t***** CURRENT OUTPUT *****\t\t\n\n");
        		bzero(command,40);
        		printf("Invalid Command!\n");
        		next();
        	}
	}
	close(sockfd);
return 0;
}
