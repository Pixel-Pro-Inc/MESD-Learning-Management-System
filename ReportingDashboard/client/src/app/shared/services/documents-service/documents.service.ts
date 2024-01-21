import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { PreferencesService } from '../preferences-service/preferences.service';

@Injectable({
  providedIn: 'root',
})
export class DocumentsService {
  constructor(
    private httpClient: HttpClient,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  applyCertificate(application: any) {
    return this.httpClient.post(
      environment.apiUrl + 'document/apply-certificate',
      application
    );
  }

  getMyCertificates(documentRequestDto: any) {
    return this.httpClient.post(
      environment.apiUrl + 'document/my-applications',
      documentRequestDto
    );
  }

  getCertificates() {
    return this.httpClient.get(
      environment.apiUrl + 'document/get-applications'
    );
  }

  deleteApplication(documentID: string) {
    return this.httpClient.get(
      environment.apiUrl +
        'document/delete-application?documentID=' +
        documentID
    );
  }

  verifyDocument(documentID: string) {
    return this.httpClient.get(
      environment.apiUrl + 'document/verify-document?documentID=' + documentID
    );
  }

  reviewCertificate(reviewCertificateDto: any) {
    return this.httpClient.post(
      environment.apiUrl + 'document/review-certificate',
      reviewCertificateDto
    );
  }
}
