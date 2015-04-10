package Commandes;

import modele.Cinema;
import modele.Salle;
import CinemaExceptions.ErreurSalle;
import CinemaExceptions.ErreurSeanceEnCours;

public class DemarrerJournee implements Commande {
	private Cinema leCinema;

	public DemarrerJournee(Cinema leCinema) {
		this.leCinema = leCinema;
	}

	public void execute() throws ErreurSeanceEnCours {
		this.demarrerJournee();

	}

	public void demarrerJournee() throws ErreurSeanceEnCours {
		// si une salle n'est pas ˆ -1, il ne faut toucher aucune salle :
		// rara cas ou on ne peut programmer offensivement.
		if (leCinema.journeeFinie()) {
			for (int i = 0; i < leCinema.getNbSalles(); i++) {
				try {
					Salle salle = leCinema.getSalle(i);
					salle.demarrerSalle();
					salle.initialiserPlacesDisposDesSeances();
				} catch (ErreurSeanceEnCours e) {
					System.out.println("erreur impossible dans DemarrerJornee");
				} catch (ErreurSalle e) {
					System.out.println("erreur impossible dans DemarrerJornee");
				}

			}
		} else
			throw new ErreurSeanceEnCours(
					"une des salles n'a pas terminŽ sa journŽe");
	}

	public void undo() {
		try {
			for (int i = 0; i < leCinema.getNbSalles(); i++) {
				Salle s = leCinema.getSalle(i);
				s.setSeanceEnCours(-1);
			}
		} catch (Exception e) {
			System.out
					.println("impossible, une opŽration peut toujours etre defaite");
		}

	}

	public String getNom() {
		return "demarrer";
	}

}
