import java.util.ArrayList;
import java.util.Scanner;

import modele.Cinema;
import modele.Film;
import modele.UtilSaisie;

import CinemaExceptions.ErreurSalle;
import CinemaExceptions.ErreurSeanceEnCours;

import CinemaExceptions.NombrePlacesErreur;
import CinemaExceptions.SaisieEntierException;
import Commandes.Acheter;
import Commandes.Afficher;
import Commandes.Cloturer;
import Commandes.DemarrerJournee;
import Commandes.ProgrammerSalle;

public class VueCinema {
	private Cinema leCinema;
	private Invocateur invocateur;

	public VueCinema(Cinema bib) {
		this.leCinema = bib;
		invocateur = new Invocateur();
	}

	/*
	 * affiche un menu, saisit la reponse et effectue en boucle cette operation 
	 * tant que la reponse donnee est incorrecte. 
	 */
	public int menuEtSaisie() {
		int rep = 0;
		try {
			System.out.println("1: creer la programmation");
			System.out.println("2 : demarrer la journee ");
			System.out.println("3 :cloturer la seance courante d'une salle ");
			System.out.println("4:acheter des billets");
			System.out.println("5 : afficher le cineme");
			System.out.println("6 : undo");
			System.out.println("7 : quitter");
			System.out.println("   Entrez votre choix: ");
			rep = UtilSaisie.lireEntierPositifInferieurA(8);
		} catch (SaisieEntierException e) {
			System.out.println(e.getMessage());
			menuEtSaisie();
		}
		return rep;
	}

	public void go() {

		boolean encore = true;
		while (encore) {
			int choix = menuEtSaisie();
			switch (choix) {
			case (1): {
				faireProgrammation();
				break;
			}
			case (2): {
				demarrerJournee();
				break;

			}

			case (3): {
				cloturer();
				break;
			}
			case (4): {
				acheter();
				break;
			}

			case (5): {
				// try {
				// invocateur.enregistre(new Afficher(leCinema));
				// } catch (Exception e) {
				// System.out
				// .println("erreur impossible, on peut toujours afficher le cinema");
				// }
				System.out.println(leCinema);
				break;
			}
			case (6): {
				invocateur.undo();
				break;
			}

			case (7): {
				System.out.println("au revoir");
				encore = false;
				break;
			}
			}
		}

	}

	public void acheter() {
		int numSalle = UtilSaisie
				.lireEntierPositifEnBoucle("entrer un numero de salle");
		System.out.println(numSalle);
		int nbBillets = UtilSaisie
				.lireEntierPositifEnBoucle("entrer un nombre de billets  ");
		System.out.println(nbBillets);
		try {
			invocateur.enregistre(new Acheter(nbBillets, numSalle, leCinema));
			System.out.println("achat effectue ");
		} catch (ErreurSalle e) {
			System.out.println(e.getMessage());
			acheter();
		} catch (NombrePlacesErreur e) {
			System.out.println("erreur dans le nombre de places");
			System.out.println(e.getMessage());
			acheter();
		} catch (ErreurSeanceEnCours e) {
			System.out.println("probleme ");
			System.out.println(e.getMessage());
		} catch (Exception e) {
			System.out
					.println("il ne devrait pas y avoir d'erreur de ce type ...");
		}
	}

	private void cloturer() {
		int numSalle = UtilSaisie
				.lireEntierPositifEnBoucle("entrer un numero de salle");
		System.out.println(numSalle);
		try {
			invocateur.enregistre(new Cloturer(leCinema, numSalle));
			// leCinema.cloturerSeanceEnCours(numSalle);
			System.out.println("la seance a bien etet cloturee");
		} catch (ErreurSalle e) {
			System.out.println(e.getMessage());
			cloturer();
		} catch (ErreurSeanceEnCours e) {
			System.out.println(e.getMessage());
			// ici on choisit de remonter au menu
		} catch (Exception e) {
			System.out
					.println("il ne devrait pas y avoir d'erreur de ce type ...");
		}
	}

	private void demarrerJournee() {
		try {
			invocateur.enregistre(new DemarrerJournee(leCinema));
			// leCinema.demarrerJournee();
			System.out.println("journée demarree");
		} catch (ErreurSeanceEnCours e) {
			System.out.println(e.getMessage());
		} catch (Exception e) {
			System.out
					.println("il ne devrait pas y avoir d'erreur de ce type ...");
		}

	}

	private void faireProgrammation() {
		if (leCinema.journeeFinie()) {
			for (int i = 0; i < leCinema.getNbSalles(); i++) {
				System.out.println("entrer les noms des films pour la salle "
						+ i + "0 pour sortir");
				ArrayList<Film> films = new ArrayList<Film>();
				Scanner sc = new Scanner(System.in);
				String nomFilm = sc.nextLine();
				while (!nomFilm.equals("0")) {
					System.out.println(nomFilm);
					films.add(new Film(nomFilm));
					nomFilm = sc.nextLine();
				}
				try {
					invocateur.enregistre(new ProgrammerSalle(leCinema, i,
							films));
					// leCinema.CreerProgrammeSalle(i, films);
				} catch (ErreurSeanceEnCours e) {
					System.out
							.println("erreur impossible dans faireProgrammation");
				} catch (Exception e) {
					System.out
							.println("il ne devrait pas y avoir d'erreur de ce type ...");
				}
			}
			System.out.println("programmation terminee");
		} else
			System.out.println("les seances ne sont pas toutes terminées");

	}

}
