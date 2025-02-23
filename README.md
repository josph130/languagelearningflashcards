# languagelearningflashcards
https://languagelearningflashcards.toolforge.org/

# WDQS query:
SELECT DISTINCT ?sensenameLabel (SAMPLE(?image) AS ?images) (GROUP_CONCAT(DISTINCT(?lemma); separator=", ") as ?lemmas) \
WHERE { \
&nbsp; ?l a ontolex:LexicalEntry ; \
&nbsp; dct:language wd:Q4426878 ; #Soyot Language \
&nbsp; wikibase:lemma ?lemma ; \
&nbsp; ontolex:sense ?sense . \
&nbsp; ?sense wdt:P5137 ?sensename . \
&nbsp; FILTER NOT EXISTS { \
&nbsp;&nbsp; ?sense wdt:P6191 wd:Q181970 . #Filter out senses with archaism \
&nbsp; } \
&nbsp; ?sensename wdt:P18 ?image . \
&nbsp; SERVICE wikibase:label { bd:serviceParam wikibase:language "en,tr". } \
} group BY ?sensenameLabel
