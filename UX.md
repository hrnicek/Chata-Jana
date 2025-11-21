# UX Design Plan – Chata Jana Ostružná

## 1. Uživatelské cesty (User Flows)

- Rezervace pobytu
  - Vstup: Uživatel přijde z Domů/Ceník → klikne „Rezervovat“.
  - Krok 1: Vybere termín v kalendáři (příjezd, odjezd), vidí cenu za noc a stav dne.
  - Ověření: Ověření dostupnosti termínu; v případě kolize jasná hláška a návrh řešení.
  - Krok 2: Vyplní kontaktní údaje (jméno, příjmení, email, telefon, poznámka).
  - Krok 3: Vybere doplňkové služby a množství; ověření dostupnosti služeb.
  - Krok 4: Zkontroluje shrnutí (termín, délka pobytu v nocích, cena ubytování, služby, celkem, upozornění na poplatky).
  - Odeslání: Odešle rezervaci; úspěch → potvrzení, instrukce k záloze, kontakty.

- Prohlížení ceníku
  - Vstup: Uživatel otevře Ceník.
  - Prohlédne sezóny, týdenní ceny, doplňkové poplatky; přejde na „Rezervovat termín“.

- Kontakt
  - Vstup: Link „Kontaktovat nás“ v CTA/ chybách.
  - Zobrazení kontaktních údajů a jednoduchého kontaktního formuláře.

## 2. Informační architektura

- Navigace
  - Domů
  - Ceník
  - Rezervace
  - Kontakt

- Struktura Rezervace
  - Sidebar: Průběh kroků, živé shrnutí (termín, noci, ubytování, služby, celkem, upozornění na poplatky).
  - Hlavní obsah: Kroky 1–5.
    - Krok 1: Kalendář + legenda stavů
    - Krok 2: Formulář osobních údajů
    - Krok 3: Doplňkové služby
    - Krok 4: Kontrola údajů
    - Krok 5: Potvrzení

## 3. Wireframy & Prototypy (textové)

- Rezervace – Krok 1 (Kalendář)
  - Header: „Vyberte termín“ + navigace měsíců
  - Legenda: Volné / Obsazené / Nedostupné
  - Mřížka dnů s cenou a sezónním štítkem
  - Footer: Zrušit výběr / Pokračovat
  - Stav načítání: skeletony; stav chyby: blok s „Zkusit znovu“

- Rezervace – Krok 2 (Osobní údaje)
  - Pole: Jméno, Příjmení, E-mail, Telefon, Poznámka
  - Validace: inline, ikonky úspěchu, `autocomplete`
  - CTA: Zpět / Pokračovat

- Rezervace – Krok 3 (Doplňkové služby)
  - Karty služeb: název, popis, cena, jednotka, počítadlo množství
  - Ověření dostupnosti: toast + perzistentní info při chybě

- Rezervace – Krok 4 (Kontrola)
  - Shrnutí termínu, nocí, cen, osobních údajů, služeb
  - Upozornění na povinné/variabilní poplatky
  - CTA: Odeslat rezervaci

- Rezervace – Krok 5 (Potvrzení)
  - Děkovná zpráva + instrukce k záloze a kontaktům
  - CTA: Nová rezervace / Zpět na úvod

## 4. Specifikace interakcí a animací

- Načítání: skeletony pro kalendář a služby.
- Ověření: spinner u CTA, vizuální disabled stavy.
- Přechody: jemné změny pozadí a bordery při výběru data a služeb.
- Sticky souhrn: na mobilu vždy viditelný, aktualizuje celkovou cenu.
- Feedback: perzistentní chybové bloky s `aria-live="polite"` a jasným řešením.

## 5. Doporučení pro přístupnost (Accessibility)

- Formuláře: `label` pro každý vstup, `autocomplete`, `inputmode` pro telefon.
- Chybové hlášky: sémantické kontejnery, `role="alert"`, `aria-live="polite"`.
- Ikony: doplnit textové štítky v legendě; nezávislé na barvě.
- Klávesnice: interaktivní prvky přístupné tabulátorem, jasné `:focus` stavy.
- Kontrast: používat dostatečný kontrast pro text a důležité prvky.

---

Tento dokument slouží jako jednotný základ pro návrh a implementaci UX. Úpravy v kódu vycházejí z uvedených principů a cílí na jasnost, konzistenci a prevenci chyb.
