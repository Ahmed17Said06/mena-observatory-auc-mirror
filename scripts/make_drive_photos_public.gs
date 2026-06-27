/**
 * Make the 47 People photo files shared "Anyone with the link (Viewer)".
 *
 * HOW TO RUN
 * 1. Go to https://script.google.com  ->  New project.
 * 2. Delete the sample code, paste this whole file, click Save.
 * 3. Run the function makePhotosPublic. On first run Google asks for
 *    authorization -> Allow (it runs as YOU, using your access to the files).
 * 4. Open View -> Logs (or the Execution log) to see per-file results.
 *
 * If a file logs an error like "shared drive"/"permission" or the sharing
 * silently stays restricted, your Google Workspace (AUC) blocks public links
 * for that file -> use the download/upload path instead.
 */

// [fileId, name]
var FILES = [
  ['1KhaKYolBPnUG7D8mLw50NYsoEYTU-J6y', 'Abdalla Ashraf'],
  ['1V8blWEnhPttDiP9kPx0GOyGSdcLfOCHC', 'Ahmad M. Awad'],
  ['1mL0XwOe7RiK1TkrkmzJHLmMp6cWZ67di', 'Ahmed Al-Bassyouni'],
  ['1uwX7iUdDw64mq_W_yOaDMs47sH0X7sLq', 'Ahmed Fakhry'],
  ['1Dy4SvIfqoW9B08iZ2sGSWebkiCd4kX_f', 'Alessandro Giovanni Lamonica'],
  ['1sOEQpwFgEIKjwIJu0vgH9KOZPsVP1NXm', 'Amr AboDraiaa'],
  ['1oqTR-FTlYkKuky_h-ggcJTvCp5qiPuoI', 'Amr Safwat'],
  ['1UIqFzs9FlNzLum3tRJyfTXz-g50Nkv5O', 'Asma Ben Hassen'],
  ['17xgBkOPqOw_rHwd0kC4g9kSIOZ-21x-q', 'Ayah Bdeir'],
  ['1i4ZU_7hlVXIyW4o7TuVN1te7-doajb-x', 'Doaa Salem Bashanfar'],
  ['1U-y-cFDT9QGucsquxyKuUa1C5q7KWbEv', 'Fola Adeleke'],
  ['1bQPZAGGQle3Am2kDuqlKFKjG7UamDBs_', 'Gretchen King'],
  ['1KA3sFzIi0PkUWHpWS7Pjv9DcAg-sJDKS', 'Hala Gohar'],
  ['10jZDgBZR1TGC0fO2_HirmjPwr2fIDc5L', 'Isaac Rutenberg'],
  ['10R7FPDnyXH14GnShcTF8zkbQqamkK2ZI', 'Karim Hamza'],
  ['1IjFyHf6n1xdpZt9HsW4ph13eE8ErwINI', 'Khalid Choukri'],
  ['16Y9V8qG7qcOiM1VgE-gbOBhGmS5nx3P9', 'Lina Oueidat'],
  ['1HIATj-1VRAbk9H9tTFk294_THzyadI5a', 'Maha Jouini'],
  ['1WDMG-gh6A0UvglE3cbO2oPaph8vO11R_', 'Mahmoud Abdallah'],
  ['1jmRBvoLeqdpN99HmPY8-eJqowgGfGzE8', 'Marwa Soudi'],
  ['1M8uWjcfcBiv6hWaoGh9_KKj-ABchfvpE', 'Marwan Abdin'],
  ['1UTCXvWTSD-2jtpQdKJQbeQwIaTlZR8p6', 'Meriem Mehri'],
  ['1k03OSloz55VAzMDvQrePdmQNOJj2rh50', 'Mia Negru'],
  ['1_QU6JxfPc2t_baz5TKeT2uwUAVlGkhuw', 'mohab said'],
  ['1nFFOzyC4ALUULz7EXzoxLKNsGuWBBwDX', 'Mohamed Abdelgawad'],
  ['1KpAwfYpLP5LSJkJD2F6gxyh5LvwbY57n', 'Mohamed Nekhely'],
  ['1S0FT0CCt7CQSiSQBtpfSdPZHrT5lLyMy', 'Mohamed Zahran'],
  ['1VWS0e_Qmj1PCJKxwnlw1WebqXpWBmWQs', 'Mona Ezat'],
  ['1jxk9qx4eEZsBkL5ptFaCYTJRt4saWUFU', 'Mostafa ElAwamy'],
  ['1raKOkT-pz1ie0DTuRBPN3CPiHyOdg4Dt', 'Nada Alwadi'],
  ['1-HKTVe2ZV7GJNtOzXlxl6lspsVsV_-59', 'Nagwa ElSayed'],
  ['1QIgclsC4v89pN1iWtPaheyUKX_zcT0BN', 'Nezar Sami'],
  ['1ixks8N4c7gq_p5Fe5-4peViiYikh44tA', 'Noha Abdel-Hamid'],
  ['1yc3E0dJ50PFXE4HqQ0HCLN68_N9ihSyF', 'Nour Naim'],
  ['1cyOlaA_eGOeR2_dP6zfmWpVNz1ZvV-i8', 'Osama Attia'],
  ['1RPYExP0d_Bks8zx9KMlFOvaYEBYyvIy5', 'Paola Ricaurte Quijano'],
  ['1ayyW9Um1bLpQm9XDRAtQHGyQtNRsDbTE', 'Sahar Albazar'],
  ['15gU04prS0mwVTbOSHL7UsFHNdK98d43q', 'Salwa Tohme Tawk'],
  ['1mpmiDh28uB7lyBG2C1SVi8wwSOCDcQph', 'Sameh Elbagoury'],
  ['1zuRjg1hu1067nezQTW5Q_EZAGZDl783d', 'Shady Elbassuoni'],
  ['145r5PaE_SMBNad4keeB3v2k6eAA5Uw-g', 'Shady Hamadeh'],
  ['171Uw3mPpYbtmW11vy5g5NkOqfdF4_hUC', 'Shahdan Arram'],
  ['1XazrtYQRnI3eVe2nFfSIC0HivTdWvwbL', 'Sherif Ali Shalan'],
  ['1BxOaRbXOm1ibU7zLsr08IPX8sAMKrNTe', 'Stephanie Boustany'],
  ['1Q8VmZXsbfI_D_bkdX0uHLpxanH7Ghm_9', 'Usama Najeeb'],
  ['1q0y90agb-USgnMVzbx8m7TTiXaI6uTS2', 'Yousif Hassan'],
  ['1uXgIk5jREgiux6fnn_v36abuFOuPY1rK', 'Yusra Ahmad'],];

function makePhotosPublic() {
  var ok = 0, fail = 0;
  for (var i = 0; i < FILES.length; i++) {
    var id = FILES[i][0], name = FILES[i][1];
    try {
      var file = DriveApp.getFileById(id);
      file.setSharing(DriveApp.Access.ANYONE_WITH_LINK, DriveApp.Permission.VIEW);
      Logger.log('OK   ' + name + '  (' + id + ')');
      ok++;
    } catch (e) {
      Logger.log('FAIL ' + name + '  (' + id + ') -> ' + e.message);
      fail++;
    }
  }
  Logger.log('---- Done. Public: ' + ok + '  |  Failed: ' + fail + ' ----');
}
