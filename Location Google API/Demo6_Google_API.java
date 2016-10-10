package geocodeResults;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URL;
import java.util.ArrayList;

import com.google.gson.Gson;

/**
 * Simple text-based application utilizing Google Maps Geocoding API to print
 * some basic information about a specified location.
 * 
 * @author Diidii
 * 
 */
public class Demo6 {

	/**
	 * 
	 * @param args
	 * @throws Exception
	 */
	public static void main(String[] args) throws Exception {
		String searchString = readFromStandardInput("Please enter the search string: ");
		String request = "http://maps.googleapis.com/maps/api/geocode/json?address="
				+ searchString + "&sensor=false";

		BufferedReader reader = read(request);
		String myJSONResult = "";
		String nextLine;
		while ((nextLine = reader.readLine()) != null) {
			myJSONResult = myJSONResult.concat(nextLine);
		}

		Gson gson = new Gson();
		GeocodeResult myResult = gson.fromJson(myJSONResult,
				GeocodeResult.class);
		ArrayList<Results> results = new ArrayList<Results>(
				myResult.getResults());
		int resultSize = myResult.getResults().size();
		if (resultSize > 1) {
			System.out.println("");
			System.out.println(myResult.getResults().size()
					+ " results (choose one for more details):");
			int i = 1;
			for (Results result : results) {
				System.out.println("[" + i++ + "] "
						+ result.getFormatted_address());
			}
			System.out.println("");
			int choice = Integer.parseInt(readFromStandardInput("Choice: "));
			Results chosenResult = results.get(--choice);
			printLocationInfo(chosenResult);
		} else if (resultSize == 1) {
			printLocationInfo(results.get(0));
		} else {
			System.out.println("Sorry, no info for this search string");
		}
	}

	/**
	 * Prints the location info of a specified result
	 * 
	 * @param chosenResult
	 *            The specified result
	 */
	public static void printLocationInfo(Results chosenResult) {
		System.out.println("");
		System.out.println("- Formatted address is: "
				+ chosenResult.getFormatted_address());
		System.out.println("");
		System.out.println("- The address components are:");
		ArrayList<AddressComponents> addressComponents = new ArrayList<AddressComponents>(
				chosenResult.getAddress_components());
		for (AddressComponents addressComponent : addressComponents) {
			System.out.println("Long name: " + addressComponent.getLong_name()
					+ ", Short name: " + addressComponent.getShort_name()
					+ ", Types: " + addressComponent.getTypes().toString()
					+ ".");

		}
		System.out.println("");
		System.out.println("- The geometry is:");
		Geometry geometry = chosenResult.getGeometry();
		System.out.println("Location type: " + geometry.getLocation_type());
		if (geometry.getLocation() != null) {
			System.out.println("Location (lat): "
					+ geometry.getLocation().getLat() + ", Location (lng): "
					+ geometry.getLocation().getLng() + ".");
		}

		if (geometry.getBounds() != null) {
			System.out.println("Bounds are: NorthEast (lat): "
					+ geometry.getBounds().getNortheast().getLat()
					+ ", NorthEast (lng): "
					+ geometry.getBounds().getNortheast().getLng()
					+ ", SouthWest (lat): "
					+ geometry.getBounds().getSouthwest().getLat()
					+ ", SouthWest (lng): "
					+ geometry.getBounds().getSouthwest().getLng() + ".");
		}
		if (geometry.getViewport() != null) {
			System.out.println("Viewports are: NorthEast (lat): "
					+ geometry.getViewport().getNortheast().getLat()
					+ ", NorthEast (lng): "
					+ geometry.getViewport().getNortheast().getLng()
					+ ", SouthWest (lat): "
					+ geometry.getViewport().getSouthwest().getLat()
					+ ", SouthWest (lng): "
					+ geometry.getViewport().getSouthwest().getLng() + ".");
		}
		System.out.println("");
		System.out.println("- The types are:");
		System.out.println(chosenResult.getTypes());

	}

	/**
	 * Reads the content of a given url
	 * 
	 * @param url
	 * @return BufferedReader
	 * @throws Exception
	 */
	public static BufferedReader read(String url) throws Exception {
		return new BufferedReader(new InputStreamReader(
				new URL(url).openStream()));
	}

	/**
	 * Reads the input from console
	 * 
	 * @param prompt
	 * @return
	 */
	public static String readFromStandardInput(String prompt) {
		InputStreamReader inp = new InputStreamReader(System.in);
		BufferedReader br = new BufferedReader(inp);
		System.out.print(prompt);
		String str;
		try {
			str = br.readLine();
			return str;
		} catch (IOException e) {
			e.printStackTrace();
			System.err.println("Cannot read from the standard input");
			System.exit(-1);
		}
		return null;
	}

}
