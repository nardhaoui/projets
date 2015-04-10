      /* --------Ceci est un programme en C qui crée un client qui se connecte à un serveur (adresse IP à définir en bas)  ----------- */
      /* --------Une fois connecté, le client envoi "bonjour" au serveur puis recoit et affiche une réponse.  ----------- */
      /* --------Ardhaoui Nidhal TDA  ----------- */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <netdb.h>

#define BUFFERSIZE 1024
int main(int argc, char *argv[]) {
     char adresseip[128] ;
      int socket_descripteur ; //code retour
      char buffer[BUFFERSIZE] ; //contenu du tampon de la taille du tampon
      struct sockaddr_in socket_addresse ;  //adresse IP
      int err ; //codes retour des fonctions
      /* saisie de l'adresse du serveur WEB */
      printf("Connexion a un serveur Web\n") ;
     
      /* ------------------- */
      socket_descripteur = socket(PF_INET, SOCK_STREAM, 0) ;
      if(!socket_descripteur) { 
	perror(" err creation socket ") ; 
	exit(0) ; 
      }
      /* ---------------------- */
      socket_addresse.sin_family = AF_INET ;
      socket_addresse.sin_port = htons(8000) ;
      socket_addresse.sin_addr.s_addr = (long)(inet_addr("Adresse du serveur a définir ici"));
      strerror((long)socket_addresse.sin_addr.s_addr);
      err = connect(socket_descripteur, (struct sockaddr *)&socket_addresse, sizeof(socket_addresse)) ; //on caste car sockaddr_in inclus dans le struct sockaddr
      if(err) { 
	perror(" err connexion serveur ") ; 
	exit(0) ; 
      }
      /* ------------------------------------- */
      strcpy(buffer, "bonjour\n") ;
      //envoyer "buffer" et traiter les erreurs 
      int sizesend = send(socket_descripteur, buffer, strlen(buffer), 0);
      if(err) { 
	perror(" err envoi ") ; exit(0) ; 
      }
      /* -----------------------------------------*/
      //recevoir "buffer" et traiter les erreurs
	int sizerecv=0;	
	do{   
	    sizerecv = recv(socket_descripteur, buffer, strlen(buffer), 0);
      if(err) { 
	perror(" err reception ") ; exit(0) ; 
      }
      buffer[sizerecv]=0 ;   
      printf("%s \n", buffer) ;    
	}while(sizerecv>0);

      /* ----------------------------------------- */
      err = close(socket_descripteur) ;
      if(err) { 
	perror(" err fermeture socket ") ; exit(0) ; 
      }
	
}

int creerTCPSocket() {
  int sock;
  if((sock = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP)) < 0){
    perror("Impossible de creer TCP socket");
    exit(1);
  }
  return sock;
}
 
