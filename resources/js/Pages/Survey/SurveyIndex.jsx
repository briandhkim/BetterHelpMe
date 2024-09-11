import LinkButtonPrimary from '@/Components/LinkButtonPrimary';
import SurveyLayout from '@/Layouts/SurveyLayout';
import {
	ClipboardDocumentListIcon,
	PlusIcon,
} from '@heroicons/react/24/outline';
import { Link } from '@inertiajs/react';
import SurveyList from './Partial/SurveyList';
import { API_V1 } from '@/Utils/constants';

const SurveyIndex = ({ pageTitle, surveys }) => {
	return (
		<SurveyLayout pageTitle={pageTitle}>
			<div className='mb-6'>
				<LinkButtonPrimary href={`${API_V1}/surveys/create`}>
					New survey
					<PlusIcon className='-mr-0.5 h-5 w-5' aria-hidden='true' />
				</LinkButtonPrimary>
			</div>
			{surveys.length ? (
				<SurveyList surveys={surveys} />
			) : (
				<div className='text-center'>
					<ClipboardDocumentListIcon
						className='mx-auto h-12 w-12 text-neutral-400'
						aria-hidden='true'
					/>
					<h3 className='mt-2 text-sm font-semibold text-gray-900'>
						No surveys
					</h3>
					<p className='mt-1 text-sm text-gray-500'>
						Get started by creating a new survey.
					</p>
					<div className='mt-6'>
						<Link
							href={`${API_V1}/surveys/create`}
							as='button'
							type='button'
							className='inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
						>
							New survey
							<PlusIcon
								className='ml-1.5 h-5 w-5'
								aria-hidden='true'
							/>
						</Link>
					</div>
				</div>
			)}
		</SurveyLayout>
	);
};

export default SurveyIndex;
