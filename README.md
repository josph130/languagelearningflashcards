# languagelearningflashcards
https://languagelearningflashcards.toolforge.org/

# WDQS query:
SELECT DISTINCT ?sensenameLabel (SAMPLE(?image) AS ?images) (GROUP_CONCAT(DISTINCT(?lemma); separator=", ") as ?lemmas) \
WHERE { \
&emsp; ?l a ontolex:LexicalEntry ; \
&emsp;&ensp; dct:language wd:Q4426878 ; #Soyot Language \
&emsp;&ensp; wikibase:lemma ?lemma ; \
&emsp;&ensp; ontolex:sense ?sense . \
&emsp; ?sense wdt:P5137 ?sensename . \
&emsp; FILTER NOT EXISTS { \
&emsp;&emsp; ?sense wdt:P6191 wd:Q181970 . #Filter out senses with archaism \
&emsp; } \
&emsp; ?sensename wdt:P18 ?image . \
&emsp; SERVICE wikibase:label { bd:serviceParam wikibase:language "en,tr". } \
} group BY ?sensenameLabel
