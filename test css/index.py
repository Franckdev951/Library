# Demander à l'utilisateur d'entrer un nombre réel
nombre = float(input("Entrez un nombre réel : "))

# Calculer la valeur absolue
if nombre < 0:
    valeur_absolue = -nombre
else:
    valeur_absolue = nombre

# Afficher la valeur absolue
print("La valeur absolue de", nombre, "est", valeur_absolue)
