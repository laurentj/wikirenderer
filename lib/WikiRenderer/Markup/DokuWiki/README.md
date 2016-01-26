Parser for [Dokuwiki syntax](https://www.dokuwiki.org/wiki:syntax)


Not supported syntax (yet):

- link ```[[namespace:foo]]```
- link ```[[namespace:foo#bar]]```
- interwiki ```[[fn>sdqd]]```
- ```[[this>qdqd]]```  qdqd is a file of dokuwiki, outside the wiki itself
- table rowspan  ( ::: in lower cells)
- ```~~macro~~```
   -  ```~~NOTOC~~``` -> do not generate toc
- footnotes ```((This is a footnote)) by using double parentheses```
- linkonly ```{{wiki:dokuwiki-128.png?linkonly}}```
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
