package modele;

import CinemaExceptions.NombrePlacesErreur;

public class Seance {
	private Film film;
	private int placesDisponible;

	// *** contr™le
	public Seance(Film f, int nbPlacesDispo) {
		this.film = f;
		this.placesDisponible = nbPlacesDispo;
	}

	public int getNbPlacesDispo() {
		return placesDisponible;
	}

	public Film getFilm() {
		return film;
	}

	public void setPlacesDisponible(int placesDisponible) {
		this.placesDisponible = placesDisponible;
	}

	public void acheter(int nbBillets) throws NombrePlacesErreur {
		if (this.getNbPlacesDispo() >= nbBillets) {
			placesDisponible = placesDisponible - nbBillets;
		} else
			throw new NombrePlacesErreur("pas assez de places");
	}

	//
	// public boolean possedeEncoreAuMoins(int nbplacesDemandees) {
	// return this.getNbPlacesDispo() >= nbplacesDemandees;
	// }

	// fin DP!!!!!!!

	public boolean passe(String f) {
		return this.getFilm().getNom().equals(f);
	}

	@Override
	public String toString() {
		return (" film : " + film.getNom() + " places disponibles : " + placesDisponible);
	}

}
