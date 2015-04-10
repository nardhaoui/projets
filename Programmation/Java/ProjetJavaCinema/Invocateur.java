
import java.util.Iterator;
import java.util.Stack;

import Commandes.Commande;

public class Invocateur {

	Stack<Commande> undoStack = new Stack<Commande>();

	public void enregistre(Commande commandObject) throws Exception {
		commandObject.execute();
		this.undoStack.push(commandObject); // push only if no exception raised
		System.out.println("commandes memorisees : " + commandsToString());
	}

	public void undo() {
		if (!undoStack.empty()) {
			Commande commande = undoStack.pop();
			try {
				System.out.println("on annule : " + commande.getNom());
				commande.undo();
			} catch (Exception e) {
				System.out.println("la commande ne peut etre annulée "
						+ e.getMessage());
			}
		} else {
			System.out.println("plus de commandes memorisees");
		}
	}

	public String commandsToString() {
		String commands = "";
		for (Commande commande : undoStack) {
			commands += commande.getNom() + "\n";
		}
		return commands;
	}

}
