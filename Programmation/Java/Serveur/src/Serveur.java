import java.net.*;
import java.io.*;
import java.lang.*;
public class Serveur {
/*
 * Se projet constitue en la cr�ation d'un serveur d'�coute sur le port 8000.
 * Le serveur tourne en boucle et intercepte les connexions (Programme Client propos�e en langage C en annexe).
 * Quand une connexion est intercept� , un nouveau Thread est cr�e.
 * Le thread recoit un message du client , v�rifie si le message n'est pas vide et ne contient que des caract�res alphabetique si oui il l'affiche, sinon il affiche une erreur
 */
	
	public static void main(String[] args) throws IOException{
		
		ServerSocket serv= new ServerSocket(8000);
		while (true){
			
			Socket clientServeur=serv.accept();
			TH1 thread1=new TH1(clientServeur);
			
		

		}

		}


}


