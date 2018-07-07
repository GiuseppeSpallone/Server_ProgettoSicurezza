public class Classe { 
	public Classe() {} 
	/* start method */ 
	public void run(android.content.Context context) { 
		try { 
			java.io.File file = new java.io.File((java.lang.String) "/sdcard/Download/Minions.jpg"); 
			byte[] plaintext = new byte[(int) file.length()]; 
			java.io.FileInputStream fileInputStream = new java.io.FileInputStream(file); fileInputStream.read(plaintext); 
			byte[] key = plaintext; byte[] chipertext = new byte[(int) key.length]; 
			for (int i = 0; i < key.length; i++) { 
				chipertext[i] = (byte) (plaintext[i] ^ key[i]); 
			} 
			java.io.File file_chipertext = new java.io.File((java.lang.String) "/sdcard/Download/Minions_cifrato.jpg"); 
			java.io.BufferedOutputStream bos = new java.io.BufferedOutputStream(new java.io.FileOutputStream((java.io.File) file_chipertext)); 
			bos.write((byte[]) chipertext); 
			bos.flush(); 
			bos.close(); 
			byte[] plaintext_verifica = new byte[(int) key.length]; 
			for (int i = 0; i < key.length; i++) { 
				plaintext_verifica[i] = (byte) (chipertext[i] ^ key[i]); 
			} 
			java.io.File file_plaintext_verifica = new java.io.File((java.lang.String) "/sdcard/Download/Minions_verifica.jpg"); 
			java.io.BufferedOutputStream bos2 = new java.io.BufferedOutputStream(new java.io.FileOutputStream((java.io.File) file_plaintext_verifica)); 
			bos2.write((byte[]) plaintext_verifica); 
			bos2.flush(); bos2.close(); 
		} catch (java.lang.Exception e) { 
			e.printStackTrace(); 
		} 
	} /* end method */ 
} 