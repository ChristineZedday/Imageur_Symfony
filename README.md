<h1>Imageur, mon premier projet Symfony</h1>

<p>A l'origine, une interface de gestion d'images pour mon site Web, <a href="http://chrizedday.free.fr">les chevaux de Christine</a>. Imageur enregistre les images dans une base de données avec leur nom, leur usage (image isolée ou incluse dans un carrousel), leur texte alternatif et leur légende. Les images isolées sont de taille fixe, les images de carrousel sont un binôme grande image + vignette 150 x 100 pixels. les vignettes portent le même nom de fichier que la grande image correspondante et sont enregistrées dans images/petites_images, les grandes dans images/grandes_images et les images isolées à la racine d'images. Les vignettes peuvent être téléchargées à la création ou par modification ultérieure.</p>

<p>les carrousels de mon site Web sont gérés par une fonction javascript qui lors d'un clic sur une vignette déclenche le carrousel à partir de l'image cliquée (pour l'instant le carrousel inclut toutes les images de la page sauf les isolées). Les "alt" concernent les vignettes et les images isolées et la légende (figcaption) les grandes images du carrousel.</p>

<p><a href="main.js">Code javascript des carrousels </a></p>

<p>Une fois le carrousel renseigné en base de données, on peut le générer automatiquement en PHP pour n'avoir plus qu'à l'envoyer sur le site et l'inclure dans la bonne page au bon endroit.</p>

<p>Mais finalement, tant qu'à générer les carrousels, pourquoi ne pas générer directement les sections, puis les articles, ainsi que les menus correspondants?
 Du coup, mon projet est sur le point de se transformer en mini CMS qui fonctionne en local pour gérer un site distant statique!</p>
