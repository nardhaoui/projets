import java.util.ArrayList;

import modele.Cinema;
import modele.Film;
/*
 * Se programme permet de gérer un Cinema.
 */
public class Lancement {

	public static void main(String[] args) {
		Cinema melies = new Cinema();
		try {
			ArrayList<Integer> l = new ArrayList<Integer>();
			l.add(20);
			l.add(10);
			melies = new Cinema(2, l);
			// ArrayList<Film> filmsDeLaSalle0 = new ArrayList<Film>();
			// filmsDeLaSalle0.add(new Film("Les combattants"));
			// filmsDeLaSalle0.add(new Film("Lucy"));
			// filmsDeLaSalle0.add(new Film("Maintenant ou jamais"));
			// ArrayList<Film> filmsDeLaSalle1 = new ArrayList<Film>();
			// filmsDeLaSalle1.add(new Film("Delivre nous du mal"));
			// filmsDeLaSalle1.add(new Film("Les combattants"));
			// filmsDeLaSalle1.add(new Film("Hunger games"));
			// melies.CreerProgrammeSalle(0, filmsDeLaSalle0);
			// melies.CreerProgrammeSalle(1, filmsDeLaSalle1);
			// melies.DemarrerJournee();
			System.out.println(melies);

		} catch (Exception e) {
			System.out.println("erreur d'initalisation");
		}

		VueCinema vue = new VueCinema(melies);
		vue.go();
	}
}
