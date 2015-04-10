import java.net.*;
import java.io.*;
import java.lang.*;
public class Serveur {
/*
 * Se projet constitue en la création d'un serveur d'écoute sur le port 8000.
 * Le serveur tourne en boucle et intercepte les connexions (Programme Client proposée en langage C en annexe).
 * Quand une connexion est intercepté , un nouveau Thread est crée.
 * Le thread recoit un message du client , vérifie si le message n'est pas vide et ne contient que des caractères alphabetique si oui il l'affiche, sinon il affiche une erreur
 */
	
	public static void main(String[] args) throws IOException{
		
		ServerSocket serv= new ServerSocket(8000);
		while (true){
			
			Socket clientServeur=serv.accept();
			TH1 thread1=new TH1(clientServeur);
			
		

		}

		}


}


