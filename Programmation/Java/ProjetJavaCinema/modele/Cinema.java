package modele;

import java.util.ArrayList;

import CinemaExceptions.ErreurCapacite;
import CinemaExceptions.ErreurSalle;
import CinemaExceptions.ErreurSeanceEnCours;
import CinemaExceptions.NombrePlacesErreur;

public class Cinema {
	Salle[] salles;

	public Cinema(int nbSalles, ArrayList<Integer> capacitesDesSalles)
			throws ErreurCapacite {
		if (nbSalles <= 0) {
			throw new ErreurCapacite(
					"il faut au moins une salle pour creer un cinema");
		}
		if (capacitesDesSalles.size() != nbSalles) {
			throw new ErreurCapacite(
					"les capacitŽs des salles ne correspondent pas au nombre de salles");
		}
		salles = new Salle[nbSalles];
		for (int i = 0; i < salles.length; i++) {
			salles[i] = new Salle(capacitesDesSalles.get(i));
		}
	}

	// on propage (code simplifie) + le boolean est inutile

	public Cinema() {
		// TODO Auto-generated constructor stub
	}

	// public void CreerProgrammeSalle(int numSalle,
	// ArrayList<Film> filmsDeLaSalleI) throws ErreurSeanceEnCours {
	// Salle laSalle = salles[numSalle];
	// laSalle.creerSeances(filmsDeLaSalleI);
	// }

	// public void DemarrerJournee() throws ErreurSeanceEnCours {
	// // si une salle n'est pas ˆ -1, il ne faut toucher aucune salle :
	// // rara cas ou on ne peut programmer offensivement.
	// if (journeeFinie()) {
	// for (Salle salle : this.salles) {
	// try {
	// salle.demarrerSalle();
	// salle.initialiserPlacesDisposDesSeances();
	// } catch (ErreurSeanceEnCours e) {
	// System.out.println("erreur impossible dans DemarrerJornee");
	// }
	// }
	// } else
	// throw new ErreurSeanceEnCours(
	// "une des salles n'a pas terminŽ sa journŽe");
	// }

	public boolean journeeFinie() {
		for (Salle s : salles) {
			if (!s.pasDeseanceEnCours()) {
				return false;
			}
		}
		return true;
	}

	// *** on propage
	// public void cloturerSeanceEnCours(int numSalle) throws ErreurSalle,
	// ErreurSeanceEnCours {
	// Salle s = this.getSalle(numSalle);
	// s.finirSeance();
	// }

	// *** controle
	public Salle getSalle(int numeroSalle) throws ErreurSalle {
		if (numeroSalle >= 0 && numeroSalle < this.salles.length) {
			return this.salles[numeroSalle];
		} else
			throw new ErreurSalle("ce n'est pas un numero de salle");
	}

	// // on propage : on a bien les 3 cas d'erreurs possibles pas de seances en cours,
	// // pas le bon um de salle, prob avec les billets
	// public void acheterSeanceEnCours(int nbBillets, int numSalle)
	// throws ErreurSalle, NombrePlacesErreur, ErreurSeanceEnCours {
	// Salle s = this.getSalle(numSalle);
	// s.acheterSeanceEnCours(nbBillets);
	// }

	public boolean passeEncoreAujourdhui(String f) {
		for (Salle salle : salles) {
			if (salle.passeEncoreAujourdhui(f)) {
				return true;
			}
		}
		return false;

	}

	// A changer en programmation offensive
	public ArrayList<Film> filmsEnCours() {
		ArrayList<Film> lesFilmsEnCours = new ArrayList<Film>();
		for (Salle salle : salles) {
			try {
				lesFilmsEnCours.add(salle.filmQuiPasse());
			} catch (ErreurSeanceEnCours e) {
				// rien a faire sauf se remettre en mode normal pour rester dans la boucle
			}
		}
		return lesFilmsEnCours;
	}

	@Override
	public String toString() {

		String s = "Cinema : " + "\n";
		for (int i = 0; i < salles.length; i++) {
			s = s + " salle numero " + i + "\n" + salles[i].toString() + "\n";
		}
		return s;
	}

	public int getNbSalles() {
		return salles.length;
	}
}
