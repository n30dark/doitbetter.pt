/** Sets progress bar to wished position
 *  @param  v   Procentual state of progress bar */
function progress_value(v)
{
  document.getElementById('progress_value').style.width=Math.max(0,Math.min(100,v))+"%";
}