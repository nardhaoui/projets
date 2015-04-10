package Commandes;

import modele.Cinema;
import modele.Salle;
import CinemaExceptions.ErreurSalle;
import CinemaExceptions.ErreurSeanceEnCours;

public class Cloturer implements Commande {

	private Salle laSalleACloturer;
	private int ancienIndiceSeanceCourante;

	public Cloturer(Cinema leCinema, int numSalle) throws ErreurSalle {
		this.laSalleACloturer = leCinema.getSalle(numSalle);
	}

	public void execute() throws ErreurSeanceEnCours {
		int n = laSalleACloturer.getIndiceSeanceEnCours();
		laSalleACloturer.finirSeance();
		ancienIndiceSeanceCourante = n;
	}

	public void undo() {
		try {
			laSalleACloturer.setSeanceEnCours(ancienIndiceSeanceCourante);
		} catch (ErreurSeanceEnCours e) {
			System.out
					.println("impossible, une action faite peut etre defaite");
		}
	}

	public String getNom() {
		return "cloturer";
	}
}