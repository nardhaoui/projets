package modele;
import java.util.Scanner;

import CinemaExceptions.SaisieEntierException;

public class UtilSaisie {

	public static int lireEntierPositif(String question)
			throws SaisieEntierException {
		Scanner scanner = new Scanner(System.in);
		System.out.println(question);
		String chaineEntier = scanner.nextLine();
		int nombre;
		try {
			nombre = Integer.parseInt(chaineEntier);
		} catch (NumberFormatException e) {
			throw new SaisieEntierException(chaineEntier + " pas un nombre ");
		}
		if (nombre < 0) {
			throw new SaisieEntierException("l'entier doit �tre positif");
		}
		return nombre;
	}

	public static int lireEntierPositifEnBoucle(String question) {
		int nombre = -1;
		do {
			try {
				nombre = lireEntierPositif(question);
			} catch (SaisieEntierException e) {
				System.out.println(e.getMessage());
			}
		} while (nombre == -1);
		return nombre;
	}

	public static int lireEntierPositifInferieurA(int n)
			throws SaisieEntierException {
		if (n >= 1) {

			Scanner scanner = new Scanner(System.in);
			String chaineEntier = scanner.nextLine();
			int nombre;
			try {
				nombre = Integer.parseInt(chaineEntier);
			} catch (NumberFormatException e) {
				throw new SaisieEntierException(chaineEntier
						+ " pas un nombre ");
			}
			if (nombre < 0 || nombre > n) {
				throw new SaisieEntierException(
						"l'entier doit �tre compris entre 1 et " + n);
			}
			return nombre;
		} else
			throw new SaisieEntierException("le parametre doit etre positif");
	}

}
