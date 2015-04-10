package Commandes;

import java.util.ArrayList;

import modele.Cinema;
import modele.Salle;
import modele.Seance;

import CinemaExceptions.ErreurSalle;
import CinemaExceptions.ErreurSeanceEnCours;
import CinemaExceptions.NombrePlacesErreur;

public class Acheter implements Commande {
	private int nbBillets;
	private int numSalle;
	private Cinema leCinema;

	public Acheter(int nbBillets, int numSalle, Cinema leCinema) {
		this.nbBillets = nbBillets;
		this.numSalle = numSalle;
		this.leCinema = leCinema;
	}

	public void acheterSeanceEnCours(int nbBillets, int numSalle)
			throws ErreurSalle, NombrePlacesErreur, ErreurSeanceEnCours {
		Salle s = this.leCinema.getSalle(numSalle);
		s.acheterSeanceEnCours(nbBillets);
	}

	public void execute() throws ErreurSalle, NombrePlacesErreur,
			ErreurSeanceEnCours {
		this.acheterSeanceEnCours(nbBillets, numSalle);
	}

	public void undo() {
		Seance seanceAchat;
		try {
			seanceAchat = this.leCinema.getSalle(numSalle).getSeanceEnCours();
			int nbPlaceActuel = seanceAchat.getNbPlacesDispo();
			seanceAchat.setPlacesDisponible(nbPlaceActuel + nbBillets);
		} catch (ErreurSeanceEnCours e) {
			System.out
					.println("erreur impossible : une action faite peut etre defaite");
		} catch (ErreurSalle e) {
			System.out
					.println("erreur impossible : une action faite peut etre defaite");
		}
	}

	public String getNom() {
		return "acheter";
	}

}
