import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation4Component } from './psdl-information-4.component';

describe('PsdlInformation4Component', () => {
  let component: PsdlInformation4Component;
  let fixture: ComponentFixture<PsdlInformation4Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation4Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation4Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
