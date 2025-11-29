from PIL import Image
import os

def convert_jpg_to_png(repertoire="."):
    """
    Liste les images d'un répertoire et convertit les .jpg en .png
    
    Args:
        repertoire: Chemin du répertoire (par défaut: répertoire courant)
    """
    # Créer un dossier pour les PNG convertis
    output_dir = os.path.join(repertoire, "converted_png")
    os.makedirs(output_dir, exist_ok=True)
    
    # Extensions à chercher
    extensions_jpg = ['.jpg', '.jpeg', '.JPG', '.JPEG']
    
    # Lister tous les fichiers
    fichiers = os.listdir(repertoire)
    images_jpg = [f for f in fichiers if any(f.endswith(ext) for ext in extensions_jpg)]
    
    print(f"📂 Répertoire: {repertoire}")
    print(f"🖼️  Images JPG trouvées: {len(images_jpg)}\n")
    
    # Conversion
    for img_name in images_jpg:
        try:
            chemin_source = os.path.join(repertoire, img_name)
            nom_sans_ext = os.path.splitext(img_name)[0]
            chemin_dest = os.path.join(output_dir, f"{nom_sans_ext}.png")
            
            # Ouvrir et sauvegarder en PNG
            img = Image.open(chemin_source)
            img.save(chemin_dest, "PNG")
            
            print(f"✅ {img_name} → {nom_sans_ext}.png")
            
        except Exception as e:
            print(f"❌ Erreur avec {img_name}: {e}")
    
    print(f"\n🎉 Conversion terminée! Fichiers dans: {output_dir}")
    
    # Renommer les PNG
    renommer_png(output_dir)

def renommer_png(repertoire):
    """
    Renomme tous les PNG en png01, png02, png03, etc.
    
    Args:
        repertoire: Chemin du répertoire contenant les PNG
    """
    # Lister tous les PNG
    fichiers = [f for f in os.listdir(repertoire) if f.endswith('.png')]
    fichiers.sort()  # Trier par ordre alphabétique
    
    print(f"\n🔄 Renommage de {len(fichiers)} fichiers PNG...\n")
    
    for i, ancien_nom in enumerate(fichiers, start=1):
        ancien_chemin = os.path.join(repertoire, ancien_nom)
        nouveau_nom = f"img{i}.png"  # Format: img1, img2, img3, etc.
        nouveau_chemin = os.path.join(repertoire, nouveau_nom)
        
        try:
            os.rename(ancien_chemin, nouveau_chemin)
            print(f"📝 {ancien_nom} → {nouveau_nom}")
        except Exception as e:
            print(f"❌ Erreur avec {ancien_nom}: {e}")
    
    print(f"\n✨ Renommage terminé!")

# Utilisation
if __name__ == "__main__":
    # Change le chemin selon tes besoins
    repertoire = "."  # Répertoire courant
    # repertoire = "/chemin/vers/tes/images"  # Ou un chemin spécifique
    
    convert_jpg_to_png(repertoire)