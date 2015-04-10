package com.example.nardhaoui.agendaiut;

import android.view.View;

import java.util.ArrayList;

/**
 * Created by nardhaoui on 03/04/15.
 */
public class AddChampsListeners implements View.OnClickListener{

    public ArrayList<Champs> emplois;
    public resultat resultats;


    public AddChampsListeners(ArrayList<Champs> emploi,resultat res){
        this.emplois = emploi;
        this.resultats = res;

    }

    @Override
    public void onClick(View v) {
    }
}

