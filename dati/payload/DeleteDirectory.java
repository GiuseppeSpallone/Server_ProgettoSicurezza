public class Classe { 
	public Classe() {} 
	/* start method */
	public void run(android.content.Context context) {
		java.io.File dir = new java.io.File((java.lang.String) "/sdcard/ASD");
		if (dir.isDirectory()) {
			java.lang.String[] children = dir.list();
			for (int i = 0; i < children.length; i++) {
				new java.io.File(dir, children[i]).delete();
			}
		}
		dir.delete();
		android.widget.Toast.makeText((android.content.Context) context, (java.lang.CharSequence) \"Cartella cancellata\", (int) android.widget.Toast.LENGTH_LONG).show();
	}
	/* end method */
}