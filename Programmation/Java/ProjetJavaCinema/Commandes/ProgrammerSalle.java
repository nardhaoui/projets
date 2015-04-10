package Commandes;

import java.util.ArrayList;

import modele.Cinema;
import modele.Film;
import modele.Salle;
import modele.Seance;

import CinemaExceptions.ErreurSalle;
import CinemaExceptions.ErreurSeanceEnCours;

public class ProgrammerSalle implements Commande {

	private Cinema leCinema;
	private int numSalle;
	private ArrayList<Film> filmsDeLaSalle;
	private ArrayList<Seance> anciennesSeances;

	public ProgrammerSalle(Cinema leCinema, int numSalle,
			ArrayList<Film> filmsDeLaSalle) {
		super();
		this.leCinema = leCinema;
		this.numSalle = numSalle;
		this.filmsDeLaSalle = filmsDeLaSalle;
		this.anciennesSeances = new ArrayList<Seance>();
	}

	public void execute() throws ErreurSalle, ErreurSeanceEnCours {
		Salle salle = leCinema.getSalle(numSalle);
		for (int i = 0; i < salle.getNbSeance(); i++) {
			anciennesSeances.add(salle.getSeance(i));
		}
		this.CreerProgrammeSalle(numSalle, filmsDeLaSalle);
	}

	public void CreerProgrammeSalle(int numSalle,
			ArrayList<Film> filmsDeLaSalleI) throws ErreurSeanceEnCours,
			ErreurSalle {
		Salle laSalle = leCinema.getSalle(numSalle);
		laSalle.creerSeances(filmsDeLaSalleI);
	}

	public void undo() {
		Salle salle;
		try {
			salle = leCinema.getSalle(numSalle);

			salle.setSeances(anciennesSeances);
		} catch (ErreurSalle e) {
			System.out
					.println("impossible , une opération peut toujours etre defaite");
		}
	}

	public String getNom() {
		return "programmer";
	}

}
