Parser for [Dokuwiki syntax](https://www.dokuwiki.org/wiki:syntax)


Not supported syntax (yet):

- table rowspan  ( ::: in lower cells)
- ```~~macro~~```
   -  ```~~NOTOC~~``` -> do not generate toc
- footnotes ```((This is a footnote)) by using double parentheses```
- support of media : should generate <video> <audio> <object> etc...
    - Image 	gif, jpg, png
    - Video 	webm, ogv, mp4   : plusieurs fichiers du même nom == alternatives
    - Audio 	ogg, mp3, wav
    - Flash 	swf
    
- video_filename.jpg for posters
- Typography:
    this:    -> <- <-> => <= <=> >> << -- --- 640x480 (c) (tm) (r)
    becomes: → ← ↔ ⇒ ⇐ ⇔ » « – — 640×480 © ™ ® 

- TOC generation

- system to retrieve the status of a wiki page
- support of raw url