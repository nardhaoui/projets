package com.example.nardhaoui.agendaiut;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.StrictMode;
import android.util.Log;
import android.view.Menu;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;
import org.xml.sax.SAXException;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

/**
 * Created by ardhaoui on 01/04/15.
 */
public class resultat extends Activity {

    private String utilisateur;
    private ListView liste;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.resultat);
        Intent intent = getIntent();
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);


        this.utilisateur = intent.getExtras().getString("login");

        this.liste = (ListView) findViewById(R.id.listeresultats);
        if(intent == null) {
            this.utilisateur="Erreur !";
            return;
        }



        ArrayList<String> content = new ArrayList<>();
        try {
            ArrayList<Champs> rssflux = renvoi_liste_rss_xml(this.utilisateur);

            for(int i=0; i<rssflux.size(); i++) {
                content.add(rssflux.get(i).description + "\n"+rssflux.get(i).titre);
            }
            if(content.size()==0){
                content.add("Veuillez renseigner un login !");
            }
            String[] str=new String[content.size()];
            ArrayAdapter<String> myAdapter=new
                    ArrayAdapter<String>(
                    this,
                    android.R.layout.simple_list_item_1,
                    content.toArray(str) );

            this.liste.setAdapter(myAdapter);
        }

        catch (Exception e) {
            e.printStackTrace();
            this.utilisateur="serveur iut down tousa tousa.";
        }

        System.out.print(utilisateur);

    }
    private ArrayList<Champs> renvoi_liste_rss_xml(String utilisateur) throws Exception{
        ArrayList<Champs> ret = new ArrayList<Champs>();
        DocumentBuilderFactory fabrique = DocumentBuilderFactory.newInstance();
        DocumentBuilder constructeur = null;
        try {
            constructeur = fabrique.newDocumentBuilder();
        } catch (ParserConfigurationException e) {
            e.printStackTrace();
        }

        Document document = null;
        InputStream openStream = null;
        try {
            HttpClient httpclient = new DefaultHttpClient();
            HttpResponse response = httpclient.execute(new HttpGet("http://agendas.iut.univ-paris8.fr/indexRSS.php?login=" + utilisateur));
            openStream = response.getEntity().getContent();
        }catch (Exception e){
            Log.e("[HTTP REQUEST]","network",e);
        }

        try {
            document = constructeur.parse(openStream);
        } catch (Exception e) {
            e.printStackTrace();
        }
        Element racine = document.getDocumentElement();
        NodeList liste = racine.getElementsByTagName("item");


        for(int i=0; i<liste.getLength(); i++){
            Element E1= (Element) liste.item(i);

            String title ="",desc="";
            for (int j=0; j<liste.item(i).getChildNodes().getLength();j++ ) {
                if(liste.item(i).getChildNodes().item(j).getNodeType() == Node.ELEMENT_NODE) {
                    Element el1 = (Element) liste.item(i).getChildNodes().item(j);
                    if (el1.getTagName().equals("title"))
                        title = liste.item(i).getChildNodes().item(j).getTextContent();
                    else if (el1.getTagName().equals("description"))
                        desc = liste.item(i).getChildNodes().item(j).getTextContent();
                }
            }
            System.out.println(title);
            ret.add(new Champs(title,desc,i));

        }

        return ret;
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        return true;
    }

}
