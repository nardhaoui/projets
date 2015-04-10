package Commandes;

import CinemaExceptions.CinemaException;

/*
 * Commande.java
 *
 * Created on 26 octobre 2011, 14:17
 *
 * To change this template, choose Tools | Template Manager
 * and open the template in the editor.
 */

/**
 * 
 * @author mariannesimonot
 */
public interface Commande {

	public void execute() throws CinemaException;

	public void undo();

	public String getNom();

}
