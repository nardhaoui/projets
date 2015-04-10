package modele;

import java.util.ArrayList;


import CinemaExceptions.ErreurCapacite;
import CinemaExceptions.ErreurSeanceEnCours;
import CinemaExceptions.NombrePlacesErreur;

public class Salle {
	private ArrayList<Seance> seances;
	private int indiceSeanceEnCours;
	private int capacite;

	public Salle(Integer capacite) throws ErreurCapacite {
		if (capacite < 0)
			throw new ErreurCapacite(
					"la capacite d'une salle ne peut être negative");
		this.seances = new ArrayList<Seance>();
		this.capacite = capacite;
		this.indiceSeanceEnCours = -1;
	}

	public void finirSeance() throws ErreurSeanceEnCours {
		if (derniereSeance()) {
			indiceSeanceEnCours = -1;
		} else if (indiceSeanceEnCours == -1) {
			throw new ErreurSeanceEnCours("pas de seances en cours");
		}

		else {
			indiceSeanceEnCours = indiceSeanceEnCours + 1;
		}
	}

	public boolean derniereSeance() {
		return indiceSeanceEnCours == seances.size() - 1;
	}

	public Seance getSeanceEnCours() throws ErreurSeanceEnCours {
		if (indiceSeanceEnCours != -1) {
			return seances.get(indiceSeanceEnCours);
		} else
			throw new ErreurSeanceEnCours(
					("les seances sont terminées dans cette salle"));
	}

	public boolean passeEncoreAujourdhui(String f) {
		if (indiceSeanceEnCours != -1) {
			for (int i = indiceSeanceEnCours + 1; i < seances.size(); i++) {
				if (seances.get(i).passe(f)) {
					return true;
				}
			}
			return false;
		} else
			return false;
	}

	// **** ici, on propage l'exception de getSeanceEnCours
	public Film filmQuiPasse() throws ErreurSeanceEnCours {
		// if (indiceSeanceEnCours != -1) {
		// return getSeanceEnCours().getFilm();
		// } else
		// return null;
		return getSeanceEnCours().getFilm();
	}

	public void demarrerSalle() throws ErreurSeanceEnCours {
		if (indiceSeanceEnCours == -1) {
			indiceSeanceEnCours = 0;
		} else
			throw new ErreurSeanceEnCours(
					"on ne peut demarer une salle dont toutes les seances ne sont pas achevees");
	}

	// **** propagation des erreurs de acheter(prob de billets) et
	// de getSeanceenCours(programmation terminee) On peut enlever le if
	public void acheterSeanceEnCours(int nbBillets) throws NombrePlacesErreur,
			ErreurSeanceEnCours {
		// if (indiceSeanceEnCours != -1) {
		Seance seanceEnCours = this.getSeanceEnCours();
		seanceEnCours.acheter(nbBillets);
		// }
	}

	@Override
	public String toString() {
		String s = "     " + " seances en cours : " + indiceSeanceEnCours
				+ " capacite : " + capacite + " \n";
		for (int i = 0; i < seances.size(); i++) {
			s = s + "     seance " + i + " : " + seances.get(i).toString()
					+ "\n";
		}
		return s;
	}

	public boolean pasDeseanceEnCours() {
		return indiceSeanceEnCours == -1;
	}

	public int getCapacite() {
		return this.capacite;
	}

	// *** controle : les seances doivent être terminées
	// doit changer à cause des différents types de seances.
	// public void creerSeances(ArrayList<Seance> seances)
	// throws ErreurSeanceEnCours {
	// if (this.pasDeseanceEnCours()) {
	// this.seances = seances;
	// this.indiceSeanceEnCours = -1;
	// } else
	// throw new ErreurSeanceEnCours(
	// "toutes les seances ne sont pas terminées");
	// }

	public void creerSeances(ArrayList<Film> filmsDeLaSalleI)
			throws ErreurSeanceEnCours {
		if (this.pasDeseanceEnCours()) {
			seances = new ArrayList<Seance>();
			for (Film f : filmsDeLaSalleI) {
				seances.add(new Seance(f, this.getCapacite()));
			}
			this.indiceSeanceEnCours = -1;
		} else
			throw new ErreurSeanceEnCours(
					"toutes les seances ne sont pas terminées");
	}

	public int getIndiceSeanceEnCours() {
		return indiceSeanceEnCours;
	}

	// pour les tests
	public Seance getSeance(int indice) {
		return this.seances.get(indice);
	}

	public void initialiserPlacesDisposDesSeances() {
		for (Seance s : seances) {
			s.setPlacesDisponible(capacite);
		}

	}

	// Pour les tests *** controle du numero de seance en cours
	public void setSeanceEnCours(int seanceEnCours) throws ErreurSeanceEnCours {
		if (seanceEnCours >= this.seances.size() || seanceEnCours <= -2) {
			throw new ErreurSeanceEnCours("pas de seance numero"
					+ seanceEnCours);
		}
		this.indiceSeanceEnCours = seanceEnCours;
	}

	public int getNbSeance() {
		return seances.size();
	}

	public void setSeances(ArrayList<Seance> anciennesSeances) {
		this.seances = anciennesSeances;
	}
}
