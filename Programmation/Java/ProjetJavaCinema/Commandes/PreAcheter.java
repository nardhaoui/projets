package Commandes;

import CinemaExceptions.ErreurSalle;
import CinemaExceptions.NombrePlacesErreur;
import modele.Cinema;
import modele.Seance;

public class PreAcheter implements Commande {

	private Cinema leCinema;
	private int nbBillets;
	private int numSalle;
	private int numSeance;

	public PreAcheter(Cinema leCinema, int nbBillets, int numSalle,
			int numSeance) {
		super();
		this.leCinema = leCinema;
		this.nbBillets = nbBillets;
		this.numSalle = numSalle;
		this.numSeance = numSeance;
	}

	public void execute() throws ErreurSalle, NombrePlacesErreur {
		Seance s = leCinema.getSalle(numSalle).getSeance(numSeance);
		s.acheter(nbBillets);
	}

	public void undo() {
		Seance s;
		try {
			s = leCinema.getSalle(numSalle).getSeance(numSeance);
			int nbPlacesActuel = s.getNbPlacesDispo();
			s.setPlacesDisponible(nbPlacesActuel + nbBillets);
		} catch (ErreurSalle e) {
			System.out.println("erreur impossible");
		}
	}

	public String getNom() {
		// TODO Auto-generated method stub
		return null;
	}

}
