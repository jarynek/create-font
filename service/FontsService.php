<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 01.08.2018
 * Time: 10:30
 */

namespace App\Service;

class FontsService {

	private $dir;
	private $zip;

	public function __construct() {
		$this->dir = '';
		$this->zip = new \ZipArchive();
	}

	/**
	 * uploadFiles
	 */
	public function uploadFiles(): void {

		if ( ! isset( $_FILES['files'] ) ) {
			throw new \Exception( 'neni files' );
		} elseif ( ! isset( $_POST['dir'] ) ) {
			throw new \Exception( 'neni dir' );
		}

		$icons = [];

		if ( ! file_exists( './icons/' . $_POST['dir'] . '' ) ) {
			mkdir( './icons/' . $_POST['dir'] . '', 0700 );
		}

		foreach ( $_FILES['files']['name'] as $key => $item ) {
			for ( $i = 0; $i < count( $_FILES['files'] ); $i ++ ) {
				$icons[ $key ][ array_keys( $_FILES['files'] )[ $i ] ] = $_FILES['files'][ array_keys( $_FILES['files'] )[ $i ] ][ $key ];
			}
		}

		if ( ! empty( $icons ) ) {
			foreach ( $icons as $key => $file ) {
				if ( ! move_uploaded_file( $file['tmp_name'], './icons/' . $_POST['dir'] . '/' . basename( $file['name'] ) ) ) {
					throw new \Exception( 'files not upload' );
				}
			}
		}

		$this->dir = $_POST['dir'];
	}

	/**
	 * createFont
	 *
	 * @param $dir
	 *
	 * @throws \Exception
	 */
	public function createFont(): void {

		if ( ! $this->dir ) {
			throw new \Exception( 'neni dir' );
		}

		shell_exec( dirname( dirname( __FILE__ ) ) . './bin/create-font.sh ' . escapeshellarg( $this->dir ) . '' );
	}

	/**
	 * createReadme
	 */
	public function createReadme(): void {
		$readme = fopen( './icons/' . $this->dir . '/README.txt', 'w' );
		$txt    = "Enjoy this\n";
		fwrite( $readme, $txt );
		fclose( $readme );
	}

	/**
	 * Download package
	 */
	public function zipPackage(): void {

		$filename = './icons/' . $this->dir . '.zip';
		$result   = new \RecursiveIteratorIterator( new \RecursiveDirectoryIterator( './icons/' . $this->dir ) );

		if ( ! file_exists( './icons/' . $this->dir ) ) {
			new \Exception( 'neni tu dir' );
		} else if ( $this->zip->open( $filename, \ZipArchive::CREATE ) !== true ) {
			new \Exception( 'nedokazu to zazipovat' );
		}

		foreach ( $result as $file ) {
			if ( $file->isDir() ) {
				continue;
			}

			$newFile = substr( $file->getPathname(), strrpos( $file->getPathname(), '/' ) + 1 );
			$this->zip->addFile( $file->getPathname(), $newFile );
		}
		$this->zip->close();
	}

	/**
	 * Clean up
	 */
	public function cleanUp() {

		if ( ! file_exists( './icons/' . $this->dir ) ) {
			new \Exception( 'neni dir pro clean' );
		}

		$result = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator('./icons/' . $this->dir, \RecursiveDirectoryIterator::SKIP_DOTS),
			\RecursiveIteratorIterator::CHILD_FIRST
		);

		foreach ($result as $file) {
			$fn = ($file->isDir() ? 'rmdir' : 'unlink');
			$fn($file->getRealPath());
		}
		rmdir('./icons/' . $this->dir);

		/**
		 * Redirect to download zip
		 */
		header( 'Location: /?download=' . $this->dir . '' );
	}

	/**
	 * downloadPackage
	 */
	public final function downloadPackage(): void {
		if ( ! isset( $_GET['download'] ) && $_GET['download'] !== '' ) {
			throw new \Exception( 'neni get nebo je empty' );
		} elseif ( ! file_exists( './icons/' . $_GET['download'] . '.zip' ) ) {
			throw new \Exception( 'neni zip v icons' );
		}

		$fileName = './icons/' . $_GET['download'] . '.zip';

		ob_end_clean();
		header( "Content-Type: application/zip" );
		header( "Content-Disposition: attachment; filename=" . pathinfo( $fileName, PATHINFO_BASENAME ) );
		header( "Content-Length: " . filesize( $fileName ) );
		readfile( $fileName );
	}
}