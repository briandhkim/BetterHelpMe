import LinkButtonPrimary from '@/Components/LinkButtonPrimary';
import LinkButtonSecondary from '@/Components/LinkButtonSecondary';
import { API_V1 } from '@/Utils/constants';
import { formatDistance } from 'date-fns';
const SurveyList = ({ surveys }) => {
	return (
		<ul role='list' className='divide-y divide-gray-400 divide-dashed'>
			{surveys.map(survey => (
				<li
					key={survey.id}
					className='flex justify-between gap-x-6 py-5'
				>
					<div className='flex min-w-0 gap-x-4'>
						<div className='min-w-0 flex-auto'>
							<p className='text-sm font-semibold leading-6 text-gray-900'>
								{survey.title}
							</p>
							<p className='mt-1 truncate text-xs leading-5 text-gray-500'>
								Created:{' '}
								{formatDistance(
									new Date(survey.created_at),
									new Date(),
									{ addSuffix: true }
								)}
							</p>
							<p className='mt-1 truncate text-xs leading-5 text-gray-500'>
								Updated:{' '}
								{formatDistance(
									new Date(survey.updated_at),
									new Date(),
									{ addSuffix: true }
								)}
							</p>
						</div>
					</div>
					<div className='hidden shrink-0 sm:flex sm:flex-col sm:items-end space-y-2'>
						<LinkButtonPrimary
						// href={`${API_V1}/surveys/${survey.id}`}
						>
							Edit
						</LinkButtonPrimary>
						<LinkButtonSecondary
							href={`${API_V1}/surveys/${survey.id}/answer`}
						>
							Answer
						</LinkButtonSecondary>
						<LinkButtonSecondary
							href={`${API_V1}/surveys/${survey.id}/stats/happy`}
						>
							Happy stats
						</LinkButtonSecondary>
						<LinkButtonSecondary
							href={`${API_V1}/surveys/${survey.id}/stats/sad`}
						>
							Sad stats
						</LinkButtonSecondary>
						{/* <LinkButtonSecondary
							href={`${API_V1}/surveys/${survey.id}/responses`}
						>
							Responses
						</LinkButtonSecondary> */}
					</div>
				</li>
			))}
		</ul>
	);
};

export default SurveyList;
