# languagelearningflashcards
https://languagelearningflashcards.toolforge.org/

# WQDS query:
SELECT DISTINCT ?sensenameLabel (SAMPLE(?image) AS ?images) (GROUP_CONCAT(DISTINCT(?lemma); separator=", ") as ?lemmas)
WHERE {
  ?l a ontolex:LexicalEntry ;
    dct:language wd:Q4426878 ; #Soyot Language
    wikibase:lemma ?lemma ;
    ontolex:sense ?sense .
  ?sense wdt:P5137 ?sensename .
  FILTER NOT EXISTS {
    ?sense wdt:P6191 wd:Q181970 . #Filter out senses with archaism
  }
  ?sensename wdt:P18 ?image .
  SERVICE wikibase:label { bd:serviceParam wikibase:language "en,tr". }
} group BY ?sensenameLabel
