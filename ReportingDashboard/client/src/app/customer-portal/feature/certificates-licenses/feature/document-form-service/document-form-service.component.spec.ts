import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DocumentFormServiceComponent } from './document-form-service.component';

describe('DocumentFormServiceComponent', () => {
  let component: DocumentFormServiceComponent;
  let fixture: ComponentFixture<DocumentFormServiceComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DocumentFormServiceComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DocumentFormServiceComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
