import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.PrintWriter;
import java.net.Socket;

public class TH1 implements Runnable {
	BufferedReader In;
	PrintWriter Out;

	public TH1(Socket clientServeur) throws IOException {

		In = new BufferedReader(new InputStreamReader(
				clientServeur.getInputStream()));
		Out = new PrintWriter(new BufferedWriter(new OutputStreamWriter(
				clientServeur.getOutputStream())), true);
		new Thread(this).start();
	}

	@Override
	public void run() {
		String str;
		while (true) {
			try {
				str = In.readLine();
				
				
				
				if (str.isEmpty() || !(str.matches("^[A-Za-z]*$"))) {
					
					System.out.println("Erreur");
				}else{
					System.out.println(str);

				}
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}

	}

}
