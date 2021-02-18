<h1>Imageur, Mon premier projet Symfony</h1>

<p>Interface de gestion d'images pour mon site Web, <a href="http://chrizedday.free.fr">les chevaux de Christine</a>. Imageur enregistre les images dans une base de données avec leur nom, leur usage (image isolée ou incluse dans un carrousel), leur texte alternatif et leur légende. Les images isolées sont de taille fixe, les images de carrousel sont un binôme grande image + vignette 150 x 100 pixels. les vignettes portent le mêe nom de fichier que la grande image correspondante et sont enregistrées dans public/uploads/petites_images, les grandes dans public/uploads/grandes_images et les images isolées à la racine de public/uploads. Les vignettes peuvent être téléchargées à la création ou par modification ultérieure.</p>

<p>les carrousels de mon site Web sont gérés par une fonction javascript qui lors d'un clic sur une vignette déclenche le carrousel à partir de l'image cliquée (pour l'instant le carrousel inclut toutes les images de la page sauf les isolées). Les "alt" concernent les vignettes et les images isolées et la légende (figcaption) les grandes images du carrousel.</p>

<p><a href="main.js">Code javascript des carrousels </a></p>
