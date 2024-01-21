import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { DocumentsService } from 'src/app/shared/services/documents-service/documents.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-applications',
  templateUrl: './applications.component.html',
  styleUrls: ['./applications.component.css'],
})
export class ApplicationsComponent implements OnInit {
  documents = [];

  constructor(
    private routerService: Router,
    private toastService: ToastrService,
    private busyService: BusyService,
    private documentsService: DocumentsService,
    private preferencesService: PreferencesService
  ) {}

  ngOnInit(): void {
    this.busyService.busy();

    this.documentsService.getCertificates().subscribe(
      (response: any) => {
        this.documents = response;

        let user = this.preferencesService.getPreferences().user;

        this.documents = this.documents.filter((d) => {
          if (user.permissions.includes(d.documentType)) {
            return d;
          }
        });

        this.busyService.idle();
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(
          'Something went wrong please try again and report the issue if it persists.',
          'Error'
        );
      }
    );
  }

  formattedDate(inputDateString: string) {
    const inputDate = new Date(inputDateString);

    const day = inputDate.getUTCDate();
    const month = inputDate.getUTCMonth() + 1; // Months are zero-indexed, so add 1
    const year = inputDate.getUTCFullYear();

    const formattedDate = `${day.toString().padStart(2, '0')}/${month
      .toString()
      .padStart(2, '0')}/${year}`;

    return formattedDate;
  }

  selectedDocument;

  verify(document: any) {
    this.selectedDocument = document;

    if (document.documentName == 'Precious Stone Dealers License') {
      this.routerService.navigateByUrl('/admin-portal/applications/psdl');
    }

    if (document.documentName == 'Rough Diamond Certificate') {
      this.routerService.navigateByUrl(
        '/admin-portal/applications/rough-diamond'
      );
    }

    if (document.documentName == 'Diamond Cutting License') {
      this.routerService.navigateByUrl('/admin-portal/applications/dcl');
    }

    if (document.documentName == 'Kimberly Process Certificate') {
      this.routerService.navigateByUrl('/admin-portal/applications/kpc');
    }

    if (document.documentName == 'Rough Diamond Export Permit') {
      this.routerService.navigateByUrl('/admin-portal/applications/rdep');
    }
  }

  onOutletLoaded(component) {
    component.document = this.selectedDocument;
  }
}
