package Commandes;

import modele.Cinema;

public class Afficher implements Commande {
	private Cinema leCinema;

	public Afficher(Cinema leCinema) {
		super();
		this.leCinema = leCinema;
	}

	public void execute() {
		System.out.println(leCinema);
	}

	public void undo() {
		// rien ˆ faire
	}

	public String getNom() {
		return "afficher";
	}

}
