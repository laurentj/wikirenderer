Parser for wiki syntax of [Trac](http://trac.edgewall.org/), as available in Trac 0.12


Not supported syntax:

- Font styles with Creole style `**bold**, //italic//, **//!WikiCreole style//**`
- list: 'a' and 'i' numbering style
- Most of macros
- Processors : div, span, td, th, tr, html, htmlcomment, diff, rst, textile
- Discussion citations: other kind of blocks (list, definition ...) inside them are
  not parsed
- table: cell content on several lines

