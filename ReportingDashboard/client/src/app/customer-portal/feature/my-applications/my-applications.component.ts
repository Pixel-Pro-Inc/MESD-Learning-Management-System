import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { DocumentsService } from 'src/app/shared/services/documents-service/documents.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-my-applications',
  templateUrl: './my-applications.component.html',
  styleUrls: ['./my-applications.component.css'],
})
export class MyApplicationsComponent implements OnInit {
  documents = [];

  constructor(
    private routerService: Router,
    private toastService: ToastrService,
    private busyService: BusyService,
    private documentsService: DocumentsService,
    private preferencesService: PreferencesService
  ) {}

  ngOnInit(): void {
    let documentRequestDto = {
      user: this.preferencesService.getPreferences().user,
    };

    this.busyService.busy();

    this.documentsService.getMyCertificates(documentRequestDto).subscribe(
      (response: any) => {
        this.documents = response;
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

  download(document: any) {
    window.open(document.fileUrl);
  }

  delete(document: any) {
    this.busyService.busy();

    this.documentsService.deleteApplication(document.documentID).subscribe(
      (response: any) => {
        window.location.reload();
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
}
